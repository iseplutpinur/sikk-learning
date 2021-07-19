<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataModel extends Render_Model
{

    // dipakai Administrator | Guru Administrator | Guru
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null, $filter = null)
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
        if ($this->level == 'Guru') {
            // get kelas guru itu
            $id_kelas = $this->db->select('b.id_kelas')
                ->from('guru a')
                ->join('guru_kelas b', 'a.nip = b.nip')
                ->where('a.id_user', $this->id_user)
                ->get()
                ->row_array();
            $id_kelas = $id_kelas != null ? $id_kelas['id_kelas'] : null;
        }


        // select tabel
        $this->db->select("
        a.nisn as id,
        a.nisn,
        a.nama,
        a.jenis_kelamin,
        a.alamat,
        a.status,
        e.nama as nama_sekolah,
        d.nama as nama_kelas");

        $this->db->from('siswa a');
        $this->db->join('users b', 'b.user_id = a.id_user', 'left');
        $this->db->join('siswa_kelas c', 'a.nisn = c.nisn', 'left');
        $this->db->join('kelas d', 'c.id_kelas = d.id', 'left');
        $this->db->join('sekolah e', 'e.id = d.id_sekolah', 'left');

        // Jika level Guru Administrator by sekolah
        if ($this->level == 'Guru Administrator') {
            $this->db->where('e.id', $id_sekolah);
        }

        // Jika level Guru by kelas
        if ($this->level == 'Guru') {
            $this->db->where('d.id', $id_kelas);
        }

        // order by
        if ($order['order'] != null) {
            $columns = $order['columns'];
            $dir = $order['order'][0]['dir'];
            $order = $order['order'][0]['column'];
            $columns = $columns[$order];
            $order_colum = $columns['data'];

            switch ($order_colum) {
                case 'nisn':
                    $order_colum = 'a.nisn';
                    break;
                case 'nama':
                    $order_colum = 'a.nama';
                    break;
                case 'nama_sekolah':
                    $order_colum = 'e.nama';
                    break;
                case 'nama_kelas':
                    $order_colum = 'd.nama';
                    break;
                case 'jenis_kelamin':
                    $order_colum = 'a.jenis_kelamin';
                    break;
                case 'alamat':
                    $order_colum = 'a.alamat';
                    break;
            }

            $this->db->order_by($order_colum, $dir);
        }

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
                $this->db->where('e.id', $filter['id_sekolah']);
            }

            // by kelas
            if ($filter['id_kelas'] != '') {
                $this->db->where('d.id', $filter['id_kelas']);
            }

            // by status
            if ($filter['status'] != '') {
                $this->db->where('a.status', $filter['status']);
            }
        }

        // pencarian
        if ($cari != null) {
            $this->db->where("(
                a.nisn LIKE '%$cari%' or
                a.nama LIKE '%$cari%' or
                a.jenis_kelamin LIKE '%$cari%' or
                e.nama LIKE '%$cari%' or
                d.nama LIKE '%$cari%' or
                a.alamat LIKE '%$cari%' or
                a.jenis_kelamin LIKE '%$cari%'
                )");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    // digunakan Guru |
    public function tambahProject($id_sekolah, $id_kelas, $nip_guru)
    {
        // get darft
        $row = $this->db
            ->select('id')
            ->from('daftar_project')
            ->where([
                'id_sekolah' => $id_sekolah,
                'id_kelas' => $id_kelas,
                'nip_guru' => $nip_guru,
                'status' => '0'
            ])
            ->get()
            ->row_array();
        if ($row != null) {
            return $row;
        } else {
            // insert
            $this->db->insert('daftar_project', [
                'id_sekolah' => $id_sekolah,
                'id_kelas' => $id_kelas,
                'nip_guru' => $nip_guru,
                'status' => '0'
            ]);
            $result = $this->db->insert_id();
            return ['id' => $result];
        }
    }

    // Digunakan Guru |
    public function simpanData($id_project, $id_sekolah, $id_kelas, $nip, $judul, $pendahuluan, $deskripsi, $tujuan, $link_sumber, $jumlah_aktifitas, $simpan_audio, $simpan_image)
    {
        $this->db->where('id', $id_project);
        $result = $this->db->update('daftar_project', [
            'id_sekolah' => $id_sekolah,
            'id_kelas' => $id_kelas,
            'nip_guru' => $nip,
            'judul' => $judul,
            'pendahuluan' => $pendahuluan,
            'deskripsi' => $deskripsi,
            'tujuan' => $tujuan,
            'link_sumber' => $link_sumber,
            'jumlah_aktifitas' => $jumlah_aktifitas,
            'suara' => $simpan_audio,
            'gambar' => $simpan_image,
            'status' => 1,
            'created_at' => Date("Y-m-d H:i:s", time())
        ]);
        return $result;
    }

    function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('data')['level'];
        $this->id_user = $this->session->userdata('data')['id'];
    }
}
