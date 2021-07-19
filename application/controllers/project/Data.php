<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends Render_Controller
{

    // Dipakai Guru |
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
        $this->breadcrumb_3 = 'Data Project';
        $this->breadcrumb_3_url = '#';

        // Guru
        if ($this->level == 'Guru') {
            $detail = $this->sekolah->getIdSekolahByIdUser($this->id_user);
            $this->data['id_sekolah'] = $detail['id_sekolah'];
            $this->data['id_kelas'] = $detail['id_kelas'];
            $this->data['nip_guru'] = $detail['nip_guru'];
            $this->content = 'project/guru/data';
        }

        // Administrator
        if ($this->level == 'Administrator') {
            $this->content = 'project/admin/data';
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
            $detail = $this->sekolah->getIdSekolahByIdUser($this->id_user);
            $this->data['id_sekolah'] = $detail['id_sekolah'];
            $this->data['id_kelas'] = $detail['id_kelas'];
            $this->data['nip_guru'] = $detail['nip_guru'];
            $this->data['id_project'] = $this->model->tambahProject($detail['id_sekolah'], $detail['id_kelas'], $detail['nip_guru']);
            $this->content = 'project/guru/tambah';
        }
        // Send data to view
        $this->render();
    }

    // Dipakai Guru |
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

    // Dipakai Guru
    public function getProject()
    {
        $id = $this->input->get("id");
        $result = $this->model->getProject($id);
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
        // get data untuk databse
        $judul              = $this->input->post('judul');
        $deskripsi          = $this->input->post('deskripsi', false);
        $pendahuluan        = $this->input->post('pendahuluan', false);
        $tujuan             = $this->input->post('tujuan', false);
        $link_sumber        = $this->input->post('link_sumber', false);
        $jumlah_aktifitas   = $this->input->post('jumlah_aktifitas', false);

        // list files yang dikirim
        $images                     = $this->input->post("image");
        $images                     = $images == null ? [] : $images;
        $audios                     = $this->input->post("audio");
        $audios                     = $audios == null ? [] : $audios;

        // list file in dir
        $this->load->helper('directory');
        $detail = $this->sekolah->getIdSekolahByIdUser($this->id_user);
        $id_sekolah = $this->input->post('id_sekolah');
        $id_kelas = $this->input->post('id_kelas');
        $nip = $this->input->post('nip');

        $nip = $nip != null ? $nip : $detail['nip_guru'];
        $id_sekolah = $id_sekolah != null ? $id_sekolah : $detail['id_sekolah'];
        $id_kelas = $id_kelas != null ? $id_kelas : $detail['id_kelas'];

        $id_project = $this->input->post('id_project');
        $path = "/files/$this->path/$id_sekolah/$id_kelas/$nip/$id_project";

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

        $exe = $this->model->simpanData($id_project, $id_sekolah, $id_kelas, $nip, $judul, $pendahuluan, $deskripsi, $tujuan, $link_sumber, $jumlah_aktifitas, $simpan_audio, $simpan_image);
        $this->output_json(["status" => $exe]);
    }

    public function upload()
    {
        $detail = $this->sekolah->getIdSekolahByIdUser($this->id_user);
        $id_sekolah = $this->input->post('id_sekolah');
        $id_kelas = $this->input->post('id_kelas');
        $nip = $this->input->post('nip');

        $nip = $nip != null ? $nip : $detail['nip_guru'];
        $id_sekolah = $id_sekolah != null ? $id_sekolah : $detail['id_sekolah'];
        $id_kelas = $id_kelas != null ? $id_kelas : $detail['id_kelas'];

        $tipe = $this->input->post('tipe');
        $id_project = $this->input->post('id_project');
        $path = "/files/$this->path/$id_sekolah/$id_kelas/$nip/$id_project/$tipe";

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
        if ($this->level != 'Guru' && $this->level != 'Administrator') {
            redirect('my404', 'refresh');
        }
        if ($this->level == 'Guru' ||  $this->level == 'Guru Administrator') {
            $this->load->model("sekolah/DaftarSekolahModel", 'sekolah');
        }

        $this->load->model("project/DataModel", 'model');
        $this->default_template = 'templates/dashboard';
        $this->load->library('plugin');
        $this->load->helper('url');
        $this->path = 'project/data';
    }
}
