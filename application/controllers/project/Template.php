<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template extends Render_Controller
{
    // Halaman =========================================================================================================
    // Dipakai Administrator | Guru Administrator
    public function index()
    {
        // Page Settings
        $this->title = 'Template Project';
        $this->navigation = ['Template'];
        $this->plugins = ['datatables'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'Daftar Project';
        $this->breadcrumb_2_url = '#';
        $this->breadcrumb_3 = 'Template';
        $this->breadcrumb_3_url = '#';

        // Administrator
        if ($this->level == 'Administrator') {
            $this->plugins = array_merge($this->plugins, ['select2']);
            $this->content = 'project/template/admin/list';
        }

        // Guru Administrator
        if ($this->level == 'Guru Administrator') {
            $this->data['sekolah'] = $this->sekolah;
            $this->content = 'project/template/guruadmin/list';
        }

        // Send data to view
        $this->render();
    }

    // Dipakai Administrator |
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
        $this->breadcrumb_3 = 'Template';
        $this->breadcrumb_3_url = base_url('project/template');
        $this->breadcrumb_4 = 'Tambah Template';
        $this->breadcrumb_4_url = '#';

        // content
        if ($this->level == 'Administrator') {
            $this->plugins = array_merge($this->plugins, ['select2']);
            $this->data['id_template'] = $this->model->tambahTemplate();
            $this->content = 'project/template/admin/tambah';
        }

        // content
        if ($this->level == 'Guru Administrator') {
            $this->data['id_template'] = $this->model->tambahTemplate($this->sekolah['id_sekolah']);
            $this->data['sekolah'] = $this->sekolah;
            $this->content = 'project/template/guruadmin/tambah';
        }

        // Send data to view
        $this->render();
    }

    // Dipakai Administrator |
    public function perbaiki($id)
    {
        // Page Settings
        $this->title = 'Perbaiki Project';
        $this->title_show = false;
        $this->navigation = ['Perbaiki Project'];
        $this->plugins = ['summernote', 'summernote-audio'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'Template Project';
        $this->breadcrumb_2_url = '#';
        $this->breadcrumb_3 = 'Data Project';
        $this->breadcrumb_3_url = base_url('project/data');
        $this->breadcrumb_4 = 'Perbaiki Project';
        $this->breadcrumb_4_url = '#';

        // content
        if ($this->level == 'Administrator') {
            $detail = $this->model->getTemplate($id);
            if ($detail) {
                $this->plugins = array_merge($this->plugins, ['select2']);
                $this->data['detail'] = $detail;
                $this->content = 'project/template/admin/perbaiki';
                $this->render();
            } else {
                redirect('my404', 'refresh');
            }
        }

        // content
        if ($this->level == 'Guru Administrator') {
            $detail = $this->model->getTemplate($id);
            if ($detail) {
                $this->data['detail'] = $detail;
                $this->data['sekolah'] = $this->sekolah;
                $this->content = 'project/template/guruadmin/perbaiki';
                $this->render();
            } else {
                redirect('my404', 'refresh');
            }
        }
    }

    // Fungsi =========================================================================================================
    // Dipakai Administrator |
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
        $count = $this->model->getAllData(null,    null,   null, $_cari, $order, $filter)->num_rows();
        $this->output_json(['recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data]);
    }

    // Dipakai Administrator |
    public function getTemplate()
    {
        $id = $this->input->get("id");
        $result = $this->model->getTemplate($id);
        $code = $result ? 200 : 500;
        $this->output_json(["data" => $result], $code);
    }

    // Dipakai Administrator |
    public function delete()
    {
        $id = $this->input->post("id");
        $detail = $this->model->getTemplate($id);
        if ($detail) {
            // Mulai transaksi
            $this->db->trans_start();
            // delete database
            $result = $this->model->delete($id);

            // delete file
            $this->load->helper('directory');

            $id_template = $detail['id'];

            $path = "/files/$this->path/$id_template";

            $images_dir = directory_map(".$path/image", FALSE, TRUE);
            $audios_dir = directory_map(".$path/audio", FALSE, TRUE);

            // delete file
            if ($images_dir) {
                foreach ($images_dir as $file) {
                    $this->deleteFile(".$path/image/" . $file);
                }
            }

            if ($audios_dir) {
                foreach ($audios_dir as $file) {
                    $this->deleteFile(".$path/audio/" . $file);
                }
            }

            // delete folder
            if (is_dir(".$path/image")) {
                rmdir(".$path/image");
            }

            if (is_dir(".$path/audio")) {
                rmdir(".$path/audio");
            }

            if (is_dir(".$path")) {
                rmdir(".$path");
            }

            $this->db->trans_complete();
            $code = $result ? 200 : 500;
            $this->output_json(["data" => $result], $code);
        } else {
            redirect('my404', 'refresh');
        }
    }

    // Dipakai Administrator |
    public function insert()
    {
        // get data untuk databse
        $judul              = $this->input->post('judul');
        $id_sekolah         = $this->input->post('id_sekolah');
        $keterangan         = $this->input->post('keterangan', false);

        // list files yang dikirim
        $images                     = $this->input->post("image");
        $images                     = $images == null ? [] : $images;
        $audios                     = $this->input->post("audio");
        $audios                     = $audios == null ? [] : $audios;

        // list file in dir
        $this->load->helper('directory');
        $id_template = $this->input->post('id_template');
        $path = "/files/$this->path/$id_template";

        $images_dir = directory_map(".$path/image", FALSE, TRUE);
        $audios_dir = directory_map(".$path/audio", FALSE, TRUE);

        // delete file tidak terpakai
        if ($images_dir) {
            foreach ($images_dir as $file) {
                if (!in_array($file, $images)) {
                    $this->deleteFile(".$path/image/" . $file);
                }
            }
        }

        if ($audios_dir) {
            foreach ($audios_dir as $file) {
                if (!in_array($file, $audios)) {
                    $this->deleteFile(".$path/audio/" . $file);
                }
            }
        }

        // jika tidak ada file maka folder akan dihapus
        if ($images_dir == false || $images == false) {
            if (is_dir(".$path/image")) {
                rmdir(".$path/image");
            }
        }

        if ($audios_dir == false || $audios == false) {
            if (is_dir(".$path/audio")) {
                rmdir(".$path/audio");
            }
        }

        $simpan_image = '';
        foreach ($images as $image) {
            $simpan_image .= ($simpan_image == '') ? $image : ('|' . $image);
        }

        $simpan_audio = '';
        foreach ($audios as $audio) {
            $simpan_audio .= ($simpan_audio == '') ? $audio : ('|' . $audio);
        }

        $exe = $this->model->simpanData($id_template, $id_sekolah, $judul, $keterangan, $simpan_audio, $simpan_image);
        $this->output_json(["status" => $exe]);
    }

    // Dipakai Administrator |
    public function upload()
    {
        $tipe = $this->input->post('tipe');
        $id_template = $this->input->post('id_template');
        $path = "/files/$this->path/$id_template/$tipe";

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

    // Dipakai Administrator |
    private function deleteFile($path)
    {
        $result = false;
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
        if ($this->level != 'Administrator' && $this->level != 'Guru Administrator') {
            redirect('my404', 'refresh');
        }

        if ($this->level == 'Administrator' ||  $this->level == 'Guru Administrator') {
            $this->load->model("sekolah/DaftarSekolahModel", 'sekolah');
        }

        $this->load->model("project/TemplateModel", 'model');

        if ($this->level == 'Guru Administrator') {
            $this->sekolah = $this->model->getSekolahByIdUser($this->id_user);
        }

        $this->default_template = 'templates/dashboard';
        $this->load->library('plugin');
        $this->load->helper('url');
        $this->path = 'project/templates';
    }
}
