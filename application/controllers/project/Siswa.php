<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends Render_Controller
{
    // Halaman =========================================================================================================
    public function index()
    {
        // Page Settings
        $this->title = 'Daftar Project';
        $this->navigation = ['Data Project'];
        $this->plugins = ['datatables'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'Daftar Project';
        $this->breadcrumb_2_url = '#';

        $this->navigation = ['Daftar Project'];

        $detail = $this->model->getDetailSekolahByIdUser($this->id_user);
        $this->data['detail'] = $detail;
        $this->content = 'project/siswa/list';

        // Send data to view
        $this->render();
    }

    // Dipakai Siswa
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
        $count = $this->model->getAllData(null,    null,   null, $_cari, $order, null)->num_rows();
        $this->output_json(['recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data]);
    }

    public function lihat($id_project = null)
    {
        // Page Settings
        $this->title = 'Detail Project';
        $this->navigation = ['Data Project'];
        $this->plugins = ['datatables'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'Daftar Project';
        $this->breadcrumb_2_url = '#';

        $this->navigation = ['Daftar Project'];

        $detail = $this->project->getProject($id_project);
        if ($detail) {
            $this->data['detail'] = $detail;
            $this->data['list_aktifitas'] = $this->aktifitas->getListAktifitas($id_project);
            $this->content = 'project/siswa/lihat';

            // Send data to view
            $this->render();
        } else {
            redirect('my404', 'refresh');
        }
    }

    // Dipakai Siswa
    public function getProject()
    {
        $id = $this->input->get("id");
        $result = $this->project->getProject($id);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }

    // Dipakai Siswa
    function __construct()
    {
        parent::__construct();
        // Cek session
        $this->sesion->cek_session();
        $this->level = $this->session->userdata('data') ? $this->session->userdata('data')['level'] : '';
        $this->id_user = $this->session->userdata('data') ? $this->session->userdata('data')['id'] : '';

        // cek level
        if ($this->level != 'Siswa') {
            redirect('my404', 'refresh');
        }
        $this->load->model("project/DataModel", 'project');
        $this->load->model("project/SiswaModel", 'model');
        $this->load->model("project/AktifitasModel", 'aktifitas');
        $this->default_template = 'templates/dashboard';
        $this->load->library('plugin');
        $this->load->helper('url');
        $this->path = 'project/data';
    }
}
