<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends Render_Controller
{

    // Dipakai Guru |
    public function index()
    {
        // Page Settings
        $this->title = 'Tambah Project';
        $this->navigation = ['Tambah Project'];
        $this->plugins = ['datatables'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'Daftar Project';
        $this->breadcrumb_2_url = '#';
        $this->breadcrumb_3 = 'Data Project';
        $this->breadcrumb_3_url = '#';

        // content
        if ($this->level == 'Guru') {
            $this->data['id_sekolah'] = $this->sekolah->getIdSekolahByIdUser($this->id_user);
            $this->data['id_kelas'] = $this->kelas->getIdKelasByIdUser($this->id_user);
            $this->content = 'project/guru/data';
        }
        // Send data to view
        $this->render();
    }

    // Dipakai Guru |
    public function tambah()
    {
        // Page Settings
        $this->title = 'Tambah Project';
        $this->title_show = false;
        $this->navigation = ['Tambah Project'];
        $this->plugins = ['summernote'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'Daftar Project';
        $this->breadcrumb_2_url = '#';
        $this->breadcrumb_3 = 'Data Project';
        $this->breadcrumb_3_url = base_url('project/data');
        $this->breadcrumb_4 = 'Tambah Project';
        $this->breadcrumb_4_url = '#';

        // content
        if ($this->level == 'Guru') {
            $this->data['id_sekolah'] = $this->sekolah->getIdSekolahByIdUser($this->id_user);
            $this->data['id_kelas'] = $this->kelas->getIdKelasByIdUser($this->id_user);
            $this->data['nip_guru'] = $this->guru->getNipGuruByIdUser($this->id_user);
            $this->data['id_project'] = $this->model->tambahProject($this->data['id_sekolah'], $this->data['id_kelas'], $this->data['nip_guru']);
            $this->content = 'project/guru/tambah';
        }
        // Send data to view
        $this->render();
    }

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

        $data = $this->model->getAllData($draw, $length, $start, $_cari, $order)->result_array();
        $count = $this->model->getAllData(null, null, null, $_cari, $order, null)->num_rows();

        $this->output_json(['recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data]);
    }


    public function getSekolah()
    {
        $id = $this->input->get("id");
        $result = $this->model->getSekolah($id);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }


    public function insert()
    {
        $nama = $this->input->post("nama");
        $alamat = $this->input->post("alamat");
        $no_telepon = $this->input->post("no_telepon");
        $status = $this->input->post("status");
        $result = $this->model->insert($nama, $alamat, $no_telepon, $status);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }


    public function update()
    {
        $id = $this->input->post("id");
        $nama = $this->input->post("nama");
        $alamat = $this->input->post("alamat");
        $no_telepon = $this->input->post("no_telepon");
        $status = $this->input->post("status");
        $result = $this->model->update($id, $nama, $alamat, $no_telepon, $status);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }


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
        $this->level = $this->session->userdata('data') ? $this->session->userdata('data')['level'] : '';
        $this->id_user = $this->session->userdata('data') ? $this->session->userdata('data')['id'] : '';

        // cek level
        if ($this->level != 'Guru') {
            redirect('my404', 'refresh');
        }
        if ($this->level == 'Guru' ||  $this->level == 'Guru Administrator') {
            $this->load->model("sekolah/DaftarSekolahModel", 'sekolah');
            $this->load->model("sekolah/KelasModel", 'kelas');
            $this->load->model("sekolah/GuruModel", 'guru');
        }

        $this->load->model("project/DataModel", 'model');
        $this->default_template = 'templates/dashboard';
        $this->load->library('plugin');
        $this->load->helper('url');
    }
}
