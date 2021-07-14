<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenataLaksana extends Render_Controller
{

    public function index()
    {
        // Page Settings
        $this->title = 'About - Penata Laksana';
        $this->navigation = ['About', "Konten Penata Laksana"];
        $this->plugins = [];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'About';
        $this->breadcrumb_2_url = '#';
        $this->breadcrumb_3 = 'Ideto';
        $this->breadcrumb_3_url = '#';

        // content
        $this->content      = 'about/penata-laksana';
        $this->data['about']  = $this->model->getData();

        // Send data to view
        $this->render();
    }

    public function insert()
    {
        // get row jika ada
        $judul = $this->input->post('judul');
        $deskripsi = $this->input->post('deskripsi');
        $exe = $this->model->inputSlider($judul, $deskripsi);
        $this->output_json(["status" => $exe]);
    }



    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
        if ($this->session->userdata('data')['level'] != 'Administrator') {
            redirect('login', 'refresh');
        }
        $this->default_template = 'templates/dashboard';
        $this->load->library('plugin');
        $this->load->helper('url');


        // model
        $this->load->model("about/PenataLaksanaModel", 'model');

        // path
        $this->path = 'images/about/ideto/';
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */