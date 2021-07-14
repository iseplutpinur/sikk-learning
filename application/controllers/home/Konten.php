<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konten extends Render_Controller
{

    public function index()
    {
        // Page Settings
        $this->title = 'Home - Konten';
        $this->navigation = ['Home', "Konten Home"];
        $this->plugins = ['summernote'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'Home';
        $this->breadcrumb_2_url = '#';
        $this->breadcrumb_3 = 'Konten';
        $this->breadcrumb_3_url = '#';

        // content
        $this->content      = 'home/konten';
        $this->data['home']  = $this->model->getData();

        // Send data to view
        $this->render();
    }

    public function insert()
    {
        // get row jika ada
        $slider_judul               = $this->input->post('slider_judul');
        $slider_deskripsi           = $this->input->post('slider_deskripsi');
        $informasi_judul            = $this->input->post('informasi_judul');
        $informasi_deskripsi        = $this->input->post('informasi_deskripsi', false);

        // list gambar yang dikirim
        $gambars                     = $this->input->post("gambar");
        $gambars                     = $gambars == null ? [] : $gambars;

        // list file in dir
        $this->load->helper('directory');
        $path = './' . $this->path;
        $files = directory_map($path, FALSE, TRUE);
        if ($files) {
            foreach ($files as $file) {
                if (!in_array($file, $gambars)) {
                    $this->deleteImage($path . $file);
                }
            }
        }

        // jika tidak ada gambar maka folder akan dihapus
        if ($files == false || $gambars == false) {
            if (is_dir($path)) {
                rmdir($path);
            }
        }

        $informasi_gambar = '';
        foreach ($gambars as $gambar) {
            $informasi_gambar .= ($informasi_gambar == '') ? $gambar : ('|' . $gambar);
        }

        $exe = $this->model->inputData($slider_judul, $slider_deskripsi, $informasi_judul, $informasi_deskripsi, $informasi_gambar);
        $this->output_json(["status" => $exe]);
    }

    public function uploadImage()
    {
        $path = './' . $this->path;
        // cek directory
        if (!is_dir($path)) {
            mkdir($path, 0755, TRUE);
        }

        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG|JPEG';
        $config['overwrite']            = false;
        $config['max_size']             = 8024;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $result = $this->upload->do_upload('image');
        if ($result) {
            $file_name = $this->upload->data("file_name");
            $url = base_url($this->path) . $file_name;
            $this->output_json([
                'url' => [
                    'status' => 1,
                    'path' => $url,
                    'file_name' => $file_name
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

    private function deleteImage($path)
    {
        if (file_exists($path)) {
            $result = unlink($path);
        }
        return $result;
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
        $this->load->model("home/KontenModel", 'model');

        // path
        $this->path = 'images/home/konten/';
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */