<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cari extends Render_Controller
{

    // dipakai Registrasi |
    public function index()
    {
        $this->load->model("sekolah/DaftarSekolahModel", 'model');
        $key = $this->input->post('q');
        $all = $this->input->post('all');
        // jika inputan ada
        if ($key) {
            $result = $this->model->cari($key);
            $result = $all ? array_merge([['id' => '', 'text' => 'Semua Sekolah']], $result) : $result;
            $this->output_json([
                "results" => $result
            ]);
        } else {
            $this->output_json([
                "results" => []
            ]);
        }
    }

    // dipakai Registrasi |
    public function getKelas()
    {
        $this->load->model("sekolah/guruModel", 'model');
        $id = $this->input->get("id_sekolah");
        $all = $this->input->get('all');
        // jika inputan ada
        if ($id) {
            $result = $this->model->getKelas($id);
            $result = $all ? array_merge([['id' => '', 'text' => 'Semua Kelas']], $result) : $result;
            $this->output_json([
                "results" => $result
            ]);
        } else {
            $this->output_json([
                "results" => []
            ]);
        }
    }

    // dipakai Registrasi |
    public function getListGuruByIdKelas()
    {
        $this->load->model("sekolah/guruModel", 'model');
        $id_kelas = $this->input->get("id_kelas");
        $all = $this->input->get('all');
        // jika inputan ada
        if ($id_kelas) {
            $result = $this->model->getListGuruByIdKelas($id_kelas);
            $result = $all ? array_merge([['id' => '', 'text' => 'Semua Guru']], $result) : $result;
            $this->output_json([
                "results" => $result
            ]);
        } else {
            $this->output_json([
                "results" => []
            ]);
        }
    }

    // dipakai Registrasi |
    public function cekNisn()
    {
        $this->load->model("sekolah/siswaModel", 'model');
        $nisn = $this->input->get("nisn");
        $result = $this->model->cekNisn($nisn);
        $this->output_json(["data" => $result]);
    }

    // dipakai Registrasi |
    public function cekNip()
    {
        $this->load->model("sekolah/guruModel", 'model');
        $nip = $this->input->get("nip");
        $result = $this->model->cekNip($nip);
        $this->output_json(["data" => $result]);
    }
}

/* End of file Pengguna.php */
/* Location: ./application/controllers/pengaturan/Pengguna.php */