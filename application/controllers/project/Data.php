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
        $this->plugins = ['summernote', 'summernote-audio'];

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
                    $this->deleteFile($path . $file);
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

    public function upload()
    {
        $nip = $this->input->post('nip');
        $tipe = $this->input->post('tipe');
        $nip = $nip != null ? $nip : $this->guru->getNipGuruByIdUser($this->id_user);
        $path = "/files/$tipe/$this->path/$nip";

        // cek directory
        if (!is_dir('.' . $path)) {
            mkdir('.' . $path, 0755, TRUE);
        }

        $config['upload_path']          = '.' . $path;
        if ($tipe == "image") {
            $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG|JPEG';
        } else if ($tipe == "audio") {
            $config['allowed_types']        = 'opus|flac|webm|weba|wav|ogg|m4a|mp3|oga|mid|amr|aiff|wma|au|aac|OPUS|FLAC|WEBM|WEBA|WAV|OGG|M4A|MP3|OGA|MID|AMR|AIFF|WMA|AU|AAC';
        }
        $megabit = 1024;
        $maxmb   = 10; // max file upload 10 mb
        $maxsize = $megabit * $maxmb;

        $config['overwrite']            = false;
        $config['max_size']             = $maxsize;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $result = $this->upload->do_upload($tipe);
        if ($result) {
            $file_name = $this->upload->data("file_name");
            $this->output_json([
                'path' => "$path/$file_name",
                'file_name' => $file_name
            ]);
        } else {
            $this->output_json([
                'message' => $this->upload->display_errors()
            ], 400);
        }
    }

    private function deleteFile($path)
    {
        if (file_exists($path)) {
            $result = unlink($path);
        }
        return $result;
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
        $this->path = 'project/data';
    }
}
