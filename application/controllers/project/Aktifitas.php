<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktifitas extends Render_Controller
{
    // Dipakai Administrator | Guru Administrator | Guru |
    public function detail($id)
    {
        // 1. Get jml aktifitas project [sudah]
        $this->data['list_aktifitas'] = $this->model->getListAktifitas($id);
        // 2. Get aktifitas project jika kurang maka buat.
        // 3. buat upload handeler
        // 4. buat display
        // 5. simpan
    }

    function __construct()
    {
        parent::__construct();
        // Cek session
        $this->sesion->cek_session();
        $this->level = $this->session->userdata('data') ? $this->session->userdata('data')['level'] : '';
        $this->id_user = $this->session->userdata('data') ? $this->session->userdata('data')['id'] : '';

        // cek level
        if ($this->level != 'Guru' && $this->level != 'Administrator' && $this->level != 'Guru Administrator') {
            redirect('my404', 'refresh');
        }
        if ($this->level == 'Guru' ||  $this->level == 'Guru Administrator') {
            $this->load->model("sekolah/DaftarSekolahModel", 'sekolah');
        }

        $this->load->model("project/AktifitasModel", 'model');
        $this->default_template = 'templates/dashboard';
        $this->load->library('plugin');
        $this->load->helper('url');
        $this->path = 'project/data';
    }
}
