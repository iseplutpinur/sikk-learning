<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cari extends Render_Controller
{

    // dipakai Registrasi |
    public function index()
    {
        $this->load->model("sekolah/DaftarSekolahModel", 'model');
        $key = $this->input->post('q');
        // jika inputan ada
        if ($key) {
            $this->output_json([
                "results" => $this->model->cari($key)
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
        // jika inputan ada
        if ($id) {
            $this->output_json([
                "results" => $this->model->getKelas($id)
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
}

/* End of file Pengguna.php */
/* Location: ./application/controllers/pengaturan/Pengguna.php */