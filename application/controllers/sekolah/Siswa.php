<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends Render_Controller
{

    // dipakai Administrator |
    public function index()
    {
        // Page Settings
        $this->title = 'Kelas';
        $this->title_show = false;
        $this->navigation = ['Sekolah', 'Siswa '];
        $this->plugins = ['datatables', 'select2'];

        // Breadcrumb setting
        $this->breadcrumb_show = false;

        $this->data['level'] = $this->level;
        $this->data['sekolah'] = $this->model->getAllSekolah();

        // content
        $this->content      = 'sekolah/siswa';

        // Send data to view
        $this->render();
    }

    // dipakai Administrator |
    public function ajax_data()
    {
        $order = ['order' => $this->input->post('order'), 'columns' => $this->input->post('columns')];
        $start = $this->input->post('start');
        $draw = $this->input->post('draw');
        $draw = $draw == null ? 1 : $draw;
        $length = $this->input->post('length');
        $cari = $this->input->post('search');


        if (isset($cari['value'])) {
            $_cari = $cari['value'];
        } else {
            $_cari = null;
        }

        // cek filter
        $filter = $this->input->post("filter");

        $data = $this->model->getAllData($draw, $length, $start, $_cari, $order, $filter)->result_array();
        $count = $this->model->getAllData(null, null,    null,   $_cari, $order, $filter)->num_rows();

        $this->output_json(['recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data]);
    }

    // dipakai Administrator |
    public function getKelas()
    {
        $id = $this->input->get("id_sekolah");
        $result = $this->model->getKelas($id);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }

    // dipakai Administrator |
    public function getSiswa()
    {
        $id = $this->input->get("id_siswa");
        $result = $this->model->getSiswa($id);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }

    // dipakai Administrator |
    public function insert()
    {
        // load model pengguna untuk insert
        $this->load->model('pengaturan/penggunaModel', 'pengguna');

        // Mulai transaksi
        $this->db->trans_start();
        // insert user
        // level siswa 5 di databasee
        $status = $this->input->post("status");
        $level = 5;
        $nama = $this->input->post("nama");
        $no_telpon = $this->input->post("no_telpon");
        $username = $this->input->post("nisn");
        $password = $this->input->post("password");
        $user = $this->pengguna->insert($level, $nama, $no_telpon, $username, $this->b_password->bcrypt_hash($password), $status == 0 ? 'Tidak Aktif' : 'Aktif');

        // insert siswa
        $id_user = $user['id'];
        $tanggal_lahir = $this->input->post("tanggal_lahir");
        $nisn = $this->input->post("nisn");
        $jenis_kelamin = $this->input->post("jenis_kelamin");
        $alamat = $this->input->post("alamat");
        $siswa = $this->model->insertSiswa($nisn, $id_user, $nama, $tanggal_lahir, $jenis_kelamin, $alamat, $status);

        // insert siswa_kelas
        $id_kelas = $this->input->post("id_kelas");
        $siswa_kelas = $this->model->insertSiswaKelas($nisn, $id_kelas, $status);

        // simpan transaksi
        $this->db->trans_complete();
        $result = $user && $siswa && $siswa_kelas;

        // kirim output
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }

    // dipakai Administrator |
    public function cekNisn()
    {
        $nisn = $this->input->get("nisn");
        $result = $this->model->cekNisn($nisn);
        $this->output_json(["data" => $result]);
    }

    // dipakai Administrator |
    public function update()
    {
        $id = $this->input->post("id");
        $nama = $this->input->post("nama");
        $sekolah = $this->input->post("sekolah");
        $status = $this->input->post("status");

        $result = $this->model->update($id, $nama, $sekolah, $status);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }

    // dipakai Administrator |
    public function delete()
    {
        $id = $this->input->post("id");
        $result = $this->model->delete($id);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }

    function __construct()
    {
        parent::__construct();
        // Cek session
        $this->sesion->cek_session();
        $this->level = $this->session->userdata('data')['level'];
        if ($this->level != 'Administrator' && $this->level != 'GuruAdmin') {
            redirect('my404', 'refresh');
        }

        $this->load->model("sekolah/siswaModel", 'model');
        $this->default_template = 'templates/dashboard';
        $this->load->library('plugin');
        $this->load->helper('url');
    }
}

/* End of file Pengguna.php */
/* Location: ./application/controllers/pengaturan/Pengguna.php */