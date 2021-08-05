<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelompok extends Render_Controller
{
    // Dipakai Administrator
    public function detail($id)
    {

        // Page Settings
        $this->title = 'Kelompok Project';
        $this->title_show = false;
        $this->navigation = ['Data Project'];
        $this->plugins = ['datatables'];

        // Breadcrumb setting
        $this->breadcrumb_1 = 'Dashboard';
        $this->breadcrumb_1_url = base_url();
        $this->breadcrumb_2 = 'Daftar Project';
        $this->breadcrumb_2_url = '#';
        $this->breadcrumb_3 = 'Data Project';
        $this->breadcrumb_3_url = base_url('project/data');
        $this->breadcrumb_4 = 'Kelompok Project';
        $this->breadcrumb_4_url = '#';
        $this->breadcrumb_show = false;

        $detail = $this->model->getProject($id);
        if ($detail) {
            $this->data['detail'] = $detail;
            // cekt status kelompok
            switch ($detail['status_kelompok']) {
                case '0':
                    // memilih metode pemilihan kelompok
                    $this->content = 'project/kelompok/metode-pemilihan-kelompok';
                    break;

                    // Metode sudah dipilih
                case '1':
                    // Kelompok Dan Anggota-nya Ditentukan Guru
                    $this->plugins = array_merge($this->plugins, ['select2']);
                    $this->content = 'project/kelompok/11-kelompok-ditentukan-guru';
                    break;

                case '2':
                    // Siswa Membuat Kelompok Dan Disetujui Guru
                    if ($this->level != 'Siswa') {
                        $this->content = 'project/kelompok/21-siswa-membuat-kelompok-dan-disetujui-guru-siswa';
                    } else {
                        $this->content = 'project/kelompok/22-siswa-membuat-kelompok-dan-disetujui-guru-admin';
                    }
                    break;

                case '3':
                    // Kelompok Ditentukan Guru Dan Siswa Memilih Kelompok
                    $this->content = 'project/kelompok/metode-pemilihan-kelompok';
                    break;
            }

            if ($detail['status_kelompok'] == 0) {
            }
            if ($detail['status_kelompok'] == 0) {
            }

            $this->render();
        } else {
            redirect('my404', 'refresh');
        }
    }

    // Dipakai Administrator
    public function simpan_metode()
    {
        $id_project = $this->input->post('id_project');
        $jumlah_max_siswa_per_kelompok = $this->input->post('jumlah_max_siswa_per_kelompok');
        $jumlah_max_kelompok = $this->input->post('jumlah_max_kelompok');
        $kelompok = $this->input->post('kelompok');
        $result = $this->model->simpanMetode($id_project, $jumlah_max_siswa_per_kelompok, $jumlah_max_kelompok, $kelompok);

        $this->output_json($result);
    }

    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function cariAnggotaUntukKelompok()
    {
        $key = $this->input->post('q');
        $id_sekolah = $this->input->post('id_sekolah');
        // jika inputan ada
        if ($key) {
            $result = $this->model->cariAnggotaUntukKelompok($id_sekolah, $key);
            $result = array_merge([['id' => $key, 'text' => $key, 'nama_kelas', null]], $result);
            $this->output_json([
                "results" => $result
            ]);
        } else {
            $this->output_json([
                "results" => []
            ]);
        }
    }
    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function ajax_list_kelompok()
    {
        $order = ['order' => $this->input->post('order'), 'columns' => $this->input->post('columns')];
        $start = $this->input->post('start');
        $draw = $this->input->post('draw');
        $draw = $draw == null ? 1 : $draw;
        $length = $this->input->post('length');
        $cari = $this->input->post('search');
        $id_project = $this->input->post("id_projcet");

        if (isset($cari['value'])) {
            $_cari = $cari['value'];
        } else {
            $_cari = null;
        }
        // cek filter
        $filter = $this->input->post("filter");

        $data = $this->model->getDataListKelompok($id_project, $draw, $length, $start, $_cari, $order, $filter)->result_array();
        $count = $this->model->getDataListKelompok($id_project, null,    null,   null, $_cari, $order, null)->num_rows();
        $this->output_json(['recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data]);
    }

    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function tambahAnggotaKelompok()
    {
        $id_kelompok = $this->input->post('id_kelompok');
        $nisn = $this->input->post('nisn');
        $nama = $this->input->post('nama');
        $keterangan = $this->input->post('keterangan');
        $result = $this->model->tambahAnggotaKelompok($id_kelompok, $nisn, $nama, $keterangan);
        $this->output_json($result);
    }

    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function ajax_data_list_siswa_project()
    {
        $order = ['order' => $this->input->post('order'), 'columns' => $this->input->post('columns')];
        $start = $this->input->post('start');
        $draw = $this->input->post('draw');
        $draw = $draw == null ? 1 : $draw;
        $length = $this->input->post('length');
        $cari = $this->input->post('search');
        $id_kelompok = $this->input->post("id_kelompok");

        if (isset($cari['value'])) {
            $_cari = $cari['value'];
        } else {
            $_cari = null;
        }
        // cek filter
        $filter = $this->input->post('filter');

        $data = $this->model->getListSiswaProject($id_kelompok, $draw, $length, $start, $_cari, $order, $filter)->result_array();
        $count = $this->model->getListSiswaProject($id_kelompok, null,    null,   null, $_cari, $order, null)->num_rows();
        $this->output_json(['recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data]);
    }

    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function insertKelompok()
    {
        $id_project = $this->input->post("id_project");
        $nama = $this->input->post("nama");
        $result = $this->model->createKelompok($id_project, $nama);
        $this->output_json($result);
    }

    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function updateKelompok()
    {
        $id = $this->input->post("id");
        $nama = $this->input->post("nama");
        $result = $this->model->updateKelompok($id, $nama);
        $this->output_json($result);
    }

    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function deleteKelompok()
    {
        $id = $this->input->post("id");
        $result = $this->model->deleteKelompok($id);
        $this->output_json($result);
    }

    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function deleteAnggota()
    {
        $id = $this->input->post("id");
        $result = $this->model->deleteAnggota($id);
        $this->output_json($result);
    }

    public function kunciKelompok()
    {
        $id_project = $this->input->post("id");
        $result = $this->model->kunciKelompok($id_project);
        $this->output_json($result);
    }

    public function upload()
    {
        $tipe = $this->input->post('tipe');
        $id_project = $this->input->post('id_project');
        $path = "/files/$this->path/$id_project/aktifitas/$tipe";

        $result = $this->files_summernote->upload($path, $tipe);

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

    public function insert()
    {
        // get data untuk databse
        $id_project                 = $this->input->post('id_project');

        // list files yang dikirim
        $images                     = $this->input->post("image");
        $images                     = $images == null ? [] : $images;
        $audios                     = $this->input->post("audio");
        $audios                     = $audios == null ? [] : $audios;
        // bersihkan file yang tidak terpakai ==========================================================================
        $id_project = $this->input->post('id_project');
        $simpan = $this->files_summernote->simpanData("/files/$this->path/$id_project/aktifitas", $images, $audios);

        // Simpan ke database ==========================================================================================
        $list_aktifitas = json_decode($this->input->post('aktifitas', false), true);
        $result = true;
        $simpan_hapus_aktifitas = true;
        // Mulai transaksi
        $this->db->trans_start();
        $id_simpan = [];
        foreach ($list_aktifitas as $id_aktifitas => $aktifitas) {
            $id_simpan[] = $id_aktifitas;
            $judul = $aktifitas['judul'];
            $jenis_upload = $aktifitas['jenis_upload'];
            $nilai = $aktifitas['nilai'];
            $template = $aktifitas['template'];
            $naskah = $aktifitas['naskah'];
            $detail = $aktifitas['detail'];
            $lembar_kerja = $aktifitas['lembar_kerja'];

            $exe = $this->model->simpanData($id_aktifitas, $judul, $jenis_upload, $nilai, $template, $naskah, $detail, $lembar_kerja, $simpan['audio'], $simpan['image']);
            if (!$exe) {
                $result = false;
            }
        }
        // simpan transaksi
        // hapus aktifitas yang tidak disimpan
        $list_aktifitas_database = $this->model->getListAktifitasForDelete($id_project);
        foreach ($list_aktifitas_database as $list) {
            if (!in_array($list['id'], $id_simpan)) {
                $exe = $this->model->deleteAktifitas($list['id']);
                if (!$exe) {
                    $simpan_hapus_aktifitas = false;
                }
            }
        }
        $simpan_jumlah = $this->model->updateJumlahAktifitas($id_project, count($id_simpan));

        $this->db->trans_complete();
        // =============================================================================================================
        $this->output_json(["status" => $result && $simpan_hapus_aktifitas && $simpan_jumlah]);
    }

    function __construct()
    {
        parent::__construct();
        // Cek session
        $this->sesion->cek_session();
        $this->level = $this->session->userdata('data') ? $this->session->userdata('data')['level'] : '';
        $this->id_user = $this->session->userdata('data') ? $this->session->userdata('data')['id'] : '';

        // cek level
        if ($this->level != 'Guru' && $this->level != 'Administrator' && $this->level != 'Guru Administrator' && $this->level != 'Siswa') {
            redirect('my404', 'refresh');
        }
        if ($this->level == 'Guru' ||  $this->level == 'Guru Administrator') {
            $this->load->model("sekolah/DaftarSekolahModel", 'sekolah');
        }

        $this->load->model("project/KelompokModel", 'model');
        $this->default_template = 'templates/dashboard';
        $this->load->library('plugin');
        $this->load->helper('url');
        $this->path = 'project/data';
    }
}
