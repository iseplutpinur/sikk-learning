<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends Render_Controller
{

    // Digunakan Registrasi
    public function index()
    {
        // page attribut
        $this->title = 'Registrasi Siswa';
        $this->plugins = ['icheck', 'select2'];

        // content
        $this->content      = 'registrasi/siswa';

        // Send data to view
        $this->render();
    }

    // Digunakan Registrasi
    public function guru()
    {
        // content
        $this->content      = 'registrasi/guru';

        // Send data to view
        $this->render();
    }

    // Digunakan Registrasi
    public function insert_siswa()
    {
        // load model pengguna untuk insert
        $this->load->model('pengaturan/penggunaModel', 'pengguna');
        $this->load->model("sekolah/siswaModel", 'model');

        // Mulai transaksi
        $this->db->trans_start();
        // insert user
        // level siswa 5 di databasee
        $status = 2;
        $level = 5;
        $nama = $this->input->post("nama");
        $no_telpon = $this->input->post("no_telpon");
        $username = $this->input->post("nisn");
        $password = $this->input->post("password");
        $user = $this->pengguna->insert($level, $nama, $no_telpon, $username, $password, $status);

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

    function __construct()
    {
        parent::__construct();
        $this->default_template = 'templates/registrasi';
        $this->load->library('plugin');
        $this->load->helper('url');
    }
}
