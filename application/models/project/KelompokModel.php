<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelompokModel extends Render_Model
{
    // Dipakai Administrator
    public function simpanMetode($id_project, $jumlah_max_siswa_per_kelompok, $jumlah_max_kelompok, $kelompok)
    {
        $data = [
            'status_kelompok' => $kelompok,
            'jumlah_max_siswa_per_kelompok' => $jumlah_max_siswa_per_kelompok,
            'jumlah_kelompok' => $jumlah_max_kelompok,
        ];
        $this->db->where('id', $id_project);
        $result = $this->db->update('daftar_project', $data);
        return $result;
    }

    // Dipakai Administrator
    public function getProject($id)
    {
        // jika level Guru Administrator get sekolah
        $id_sekolah = '';
        if ($this->level == 'Guru Administrator') {
            // get sekolah guru itu
            $id_sekolah = $this->db->select('id_sekolah')
                ->from('guru')
                ->where('id_user', $this->id_user)
                ->get()
                ->row_array();
            $id_sekolah = $id_sekolah != null ? $id_sekolah['id_sekolah'] : null;
        }

        // jika level Guru get kelas
        $id_kelas = '';
        $nip_guru = '';
        if ($this->level == 'Guru') {
            // get kelas guru itu
            $id_kelas = $this->db->select('b.id_kelas, a.nip')
                ->from('guru a')
                ->join('guru_kelas b', 'a.nip = b.nip')
                ->where('a.id_user', $this->id_user)
                ->get()
                ->row_array();
            $nip_guru = $id_kelas != null ? $id_kelas['nip'] : null;
            $id_kelas = $id_kelas != null ? $id_kelas['id_kelas'] : null;
        }

        // select tabel
        $this->db->select("
                a.id,
                a.judul,
                a.pendahuluan,
                a.deskripsi,
                a.tujuan,
                a.jumlah_aktifitas,
                a.link_sumber,
                a.status,
                d.nama as nama_sekolah,
                d.id as id_sekolah,
                c.nama as nama_kelas,
                c.id as id_kelas,
                b.nama as nama_guru,
                b.nip as nip_guru,
                a.created_at,
                a.updated_at,
                a.status_kelompok
            ");

        $this->db->from('daftar_project a');
        $this->db->join('guru b', 'a.nip_guru = b.nip', 'left');
        $this->db->join('kelas c', 'a.id_kelas = c.id', 'left');
        $this->db->join('sekolah d', 'a.id_sekolah = d.id', 'left');
        $this->db->where('a.id', $id);

        // Jika level Guru Administrator by sekolah
        if ($this->level == 'Guru Administrator') {
            $this->db->where('d.id', $id_sekolah);
        }

        // Jika level Guru by kelas
        if ($this->level == 'Guru') {
            $this->db->where('c.id', $id_kelas);
            $this->db->where('b.nip', $nip_guru);
        }

        $result = $this->db->get()->row_array();
        return $result;
    }

    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function cariAnggotaUntukKelompok($id_sekolah, $key)
    {
        $result = $this->db
            ->select("a.nisn as id, CONCAT(b.nama,'|',a.nama) as text, b.nama as nama_kelas")
            ->from('siswa a')
            ->join('kelas b', 'a.id_kelas = b.id', 'left')
            ->join('sekolah c', 'b.id_sekolah = c.id', 'left')
            ->where('c.id', $id_sekolah)
            ->where("(
                a.nama LIKE '%$key%' or
                b.nama LIKE '%$key%' or
                c.nama LIKE '%$key%'
            )")
            ->get()->result_array();
        return $result;
    }
    // Dipakai Administrator
    // 01 Kelompok Ditentukan Guru
    public function getDataListKelompok($id_projct, $draw = null, $show = null, $start = null, $cari = null, $order = null, $filter = null)
    {
        // select tabel
        $this->db->select("
            a.*,
            (select count(*) from siswa_kelompok_detail b where a.id = b.id_kelompok) as jumlah_siswa
        ");

        $this->db->from('siswa_kelompok a');
        $this->db->where('a.id_project', $id_projct);

        // order by
        // if ($order['order'] != null) {
        //     $columns = $order['columns'];
        //     $dir = $order['order'][0]['dir'];
        //     $order = $order['order'][0]['column'];
        //     $columns = $columns[$order];
        //     $order_colum = $columns['data'];

        //     // switch ($order_colum) {
        //     //     case 'id':
        //     //         $order_colum = 'a.id';
        //     //         break;
        //     // }

        //     $order_colum = 'a.' . $order_colum;

        //     $this->db->order_by($order_colum, $dir);
        // }

        // initial data table
        if ($draw == 1) {
            $this->db->limit(10, 0);
        }

        // filter
        if ($filter != null) {
            // cari
            $cari = $filter['kata_kunci'] != '' ? $filter['kata_kunci'] : $cari;

            // by sekolah
            if ($filter['id_sekolah'] != '') {
                $this->db->where('d.id', $filter['id_sekolah']);
            }
        }

        // pencarian
        if ($cari != null) {
            $this->db->where("(
                a.nama LIKE '%$cari%' or
                )");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    // 01 Kelompok Ditentukan Guru
    public function getListSiswaProject($id_projct, $draw = null, $show = null, $start = null, $cari = null, $order = null, $filter = null)
    {
        // get id kelas
        $id_kelas = $this->db->select('a.id_kelas')->from('daftar_project a')->where('id', $id_projct)->get()->row_array();
        $id_kelas = $id_kelas == null ? 0 : $id_kelas['id_kelas'];

        // select tabel
        $this->db->select("*");
        $this->db->from("siswa_kelompok_detail a");
        $this->db->join('siswa b', 'a.nisn_siswa = b.nisn', 'left');
        $this->db->join('kelas c', 'c.id = b.id_kelas', 'left');

        // order by
        if ($order['order'] != null) {
            $columns = $order['columns'];
            $dir = $order['order'][0]['dir'];
            $order = $order['order'][0]['column'];
            $columns = $columns[$order];
            $order_colum = $columns['data'];

            switch ($order_colum) {
                case 'id':
                    $order_colum = 'a.id';
                    break;
            }

            $this->db->order_by($order_colum, $dir);
        }

        // initial data table
        if ($draw == 1) {
            $this->db->limit(10, 0);
        }

        // // filter
        // if ($filter != null) {
        //     // cari
        //     $cari = $filter['kata_kunci'] != '' ? $filter['kata_kunci'] : $cari;

        //     // by sekolah
        //     if ($filter['id_sekolah'] != '') {
        //         $this->db->where('d.id', $filter['id_sekolah']);
        //     }
        // }

        // pencarian
        if ($cari != null) {
            $this->db->where("(
                a.nama LIKE '%$cari%' or
                )");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();

        return $result;
    }

    public function createKelompok($id_projct, $nama)
    {
        $result = $this->db->insert('siswa_kelompok', ['id_project' => $id_projct, 'nama' => $nama]);
        return $result;
    }

    public function updateKelompok($id, $nama)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('siswa_kelompok', ['nama' => $nama]);
        return $result;
    }

    public function deleteKelompok($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->delete('siswa_kelompok');
        return $result;
    }

    public function getListAktifitas($id)
    {
        // get Jumlah aktifitas dari tabel daftar_project
        $jml_aktifitas = $this->db
            ->select("jumlah_aktifitas")
            ->from("daftar_project")
            ->where("id", $id)
            ->get()
            ->row_array();

        $daftar_project_detail = $this->db
            ->select("*")
            ->from("daftar_project_detail")
            ->where("id_daftar_project", $id)
            ->where("status", 1)
            ->get();

        // bandingkan jika kurang maka buat lagi
        $jml_yang_ada = $daftar_project_detail->num_rows();
        $jml_di_tabel = $jml_aktifitas['jumlah_aktifitas'];
        $kurang = $jml_di_tabel - $jml_yang_ada;
        $results = [];
        if ($jml_yang_ada < $jml_di_tabel) {
            for ($i = 0; $i < $kurang; $i++) {
                $results[] = $this->creteAktifitas($id, 1);
            }
        }
        $results = array_merge($daftar_project_detail->result_array(), $results);
        return $results;
    }

    public function getListAktifitasForDelete($id_project)
    {
        $lists = $this->db
            ->select("id")
            ->from("daftar_project_detail")
            ->where("id_daftar_project", $id_project)
            ->get()
            ->result_array();
        return $lists;
    }

    public function deleteAktifitas($id)
    {
        $result = $this->db->delete('daftar_project_detail', ['id' => $id]);
        return $result;
    }

    public function updateJumlahAktifitas($id_project, $jumlah_aktifitas)
    {
        $data = [
            'jumlah_aktifitas' => $jumlah_aktifitas
        ];
        $this->db->where('id', $id_project);
        $result = $this->db->update('daftar_project', $data);
        return $result;
    }

    public function creteAktifitas($id_daftar_project, $status = 0)
    {
        // insert
        $this->db->insert('daftar_project_detail', [
            'id_daftar_project' => $id_daftar_project,
            'status' => $status
        ]);
        $result = $this->db->insert_id();
        return ['id' => $result, 'id_daftar_project' => $id_daftar_project];
    }

    public function getListTemplates($id_sekolah)
    {
        $result  = $this->db->select("id, judul")->from("templates")->where("id_sekolah", $id_sekolah)->get()->result_array();
        return $result;
    }

    public function simpanData($id_aktifitas, $judul, $jenis_upload, $nilai, $template, $naskah, $detail, $lembar_kerja, $simpan_audio, $simpan_image)
    {
        $tipe = $this->input->post("tipe");
        $data = [
            'judul' => $judul,
            'jenis_upload' => $jenis_upload,
            'nilai' => $nilai,
            'naskah' => $naskah,
            'detail' => $detail,
            'lembar_kerja' => $lembar_kerja,
            'id_template' => $template,
            'suara' => $simpan_audio,
            'gambar' => $simpan_image,
            'status' => 1
        ];
        if ($tipe) {
            $data['updated_at'] = Date("Y-m-d H:i:s", time());
        } else {
            $data['created_at'] = Date("Y-m-d H:i:s", time());
        }

        $this->db->where('id', $id_aktifitas);
        $result = $this->db->update('daftar_project_detail', $data);
        return $result;
    }

    function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('data')['level'];
        $this->id_user = $this->session->userdata('data')['id'];
    }
}
