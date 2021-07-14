<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyerahan extends Render_Controller
{

    public function index()
    {
        // Page Settings
        $this->title = 'About - Penyerahan';
        $this->navigation = ['About', "Konten Penyerahan"];
        $this->plugins = ['summernote'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'About';
        $this->breadcrumb_2_url = '#';
        $this->breadcrumb_3 = 'Penyerahan';
        $this->breadcrumb_3_url = '#';

        // content
        $this->content      = 'about/penyerahan';
        $this->data['about']  = $this->model->getData();

        // Send data to view
        $this->render();
    }

    public function insert()
    {
        // get row jika ada
        $slider_judul       = $this->input->post('slider_judul');
        $slider_deskripsi   = $this->input->post('slider_deskripsi');
        $judul_1            = $this->input->post('judul_1');
        $deskripsi_1        = $this->input->post('deskripsi_1', false);
        $judul_2            = $this->input->post('judul_2');
        $deskripsi_2        = $this->input->post('deskripsi_2', false);
        $judul_3            = $this->input->post('judul_3');
        $deskripsi_3        = $this->input->post('deskripsi_3', false);
        $judul_4            = $this->input->post('judul_4');
        $deskripsi_4        = $this->input->post('deskripsi_4', false);
        $judul_5            = $this->input->post('judul_5');
        $deskripsi_5        = $this->input->post('deskripsi_5', false);
        $judul_6            = $this->input->post('judul_6');
        $deskripsi_6        = $this->input->post('deskripsi_6', false);
        $exe = $this->model->inputData($slider_judul, $slider_deskripsi, $judul_1, $deskripsi_1, $judul_2, $deskripsi_2, $judul_3, $deskripsi_3, $judul_4, $deskripsi_4, $judul_5, $deskripsi_5, $judul_6, $deskripsi_6);
        $this->output_json(["status" => $exe]);
    }

    public function uploadImage()
    {
        $path = $this->path;
        $config['upload_path']          = './' . $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG|JPEG';
        $config['overwrite']            = false;
        $config['max_size']             = 8024;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $result = $this->upload->do_upload('image');
        if ($result) {
            $file_name = $this->upload->data("file_name");
            $url = base_url($path) . $file_name;
            $this->output_json([
                'url' => [
                    'status' => 1,
                    'path' => $url,
                    'file_name' => $file_name,
                    'path_upload' => './' . $path . $file_name
                ]
            ]);
        } else {
            $this->output_json([
                'url' => [
                    'status' => 0,
                    'message' => $this->upload->display_errors()
                ]
            ], 500);
        }
    }

    public function deleteImage()
    {
        $name = $this->input->post('name');
        $path = './' . $this->path . $name;
        $result = true;

        if (file_exists($path)) {
            $result = unlink($path);
        }

        $this->output_json([
            'url' => [
                'status' => $result,
                'path_upload' => $path
            ]
        ]);
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
        $this->load->model("about/PenyerahanModel", 'model');

        // path
        $this->path = 'images/about/penyerahan/';
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */