<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends Render_Model
{
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null, $filter = null)
    {
        if ($this->level == 'Siswa') {
            $id_sekolah = $this->db->select('c.id')
                ->from('siswa a')
                ->join('kelas b', 'a.id_kelas = b.id', 'left')
                ->join('sekolah c', 'b.id_sekolah = c.id', 'left')
                ->where('a.id_user', $this->id_user)
                ->get()
                ->row_array();
            $id_sekolah = $id_sekolah != null ? $id_sekolah['id'] : null;
        }

        // select tabel
        $this->db->select("
            e.id as id_kelompok,
            a.id,
            a.judul,
            a.pendahuluan,
            a.deskripsi,
            a.tujuan,
            a.jumlah_aktifitas,
            a.status,
            d.nama as nama_sekolah,
            c.nama as nama_kelas,
            b.nama as nama_guru,
            a.created_at,
            a.updated_at,
        ");

        $this->db->from('daftar_project a');
        $this->db->join('guru b', 'a.nip_guru = b.nip', 'left');
        $this->db->join('kelas c', 'a.id_kelas = c.id', 'left');
        $this->db->join('sekolah d', 'a.id_sekolah = d.id', 'left');
        $this->db->join('siswa_kelompok e', 'a.id = e.id_project', 'left');
        $this->db->join('siswa_kelompok_detail f', 'e.id = f.id_kelompok', 'left');
        $this->db->join('siswa g', 'f.nisn_siswa = g.nisn', 'left');
        $this->db->where('a.status <> 0');

        // Jika level Siswa by kelas
        if ($this->level == 'Siswa') {
            $this->db->where('d.id', $id_sekolah);
        }

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
                case 'judul':
                    $order_colum = 'a.judul';
                    break;
                case 'pendahuluan':
                    $order_colum = 'a.pendahuluan';
                    break;
                case 'deskripsi':
                    $order_colum = 'a.deskripsi';
                    break;
                case 'tujuan':
                    $order_colum = 'a.tujuan';
                    break;
                case 'jumlah_aktifitas':
                    $order_colum = 'a.jumlah_aktifitas';
                    break;
                case 'status':
                    $order_colum = 'a.status';
                    break;
                case 'created_at':
                    $order_colum = 'a.created_at';
                    break;
                case 'nama_sekolah':
                    $order_colum = 'd.nama';
                    break;
                case 'nama_kelas':
                    $order_colum = 'c.nama';
                    break;
                case 'nama_guru':
                    $order_colum = 'b.nama';
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
                $this->db->where('d.id', $filter['id_sekolah']);
            }

            // by kelas
            if ($filter['id_kelas'] != '') {
                $this->db->where('c.id', $filter['id_kelas']);
            }

            // by kelas
            if ($filter['nip_guru'] != '') {
                $this->db->where('b.nip', $filter['nip_guru']);
            }

            // by status
            if ($filter['status'] != '') {
                $this->db->where('a.status', $filter['status']);
            }
        }

        // pencarian
        if ($cari != null) {
            $this->db->where("(
                a.pendahuluan LIKE '%$cari%' or
                a.deskripsi LIKE '%$cari%' or
                a.tujuan LIKE '%$cari%' or
                a.jumlah_aktifitas LIKE '%$cari%' or
                a.link_sumber LIKE '%$cari%' or
                a.status LIKE '%$cari%' or
                d.nama LIKE '%$cari%' or
                b.nama LIKE '%$cari%' or
                c.nama LIKE '%$cari%'
                )");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    public function getDetailSekolahByIdUser($id_user)
    {
        $id_sekolah = $this->db->select('
        c.id as id_sekolah,
        c.nama as nama_sekolah,
        b.id as id_kelas,
        b.nama as nama_kelas,
        a.nisn as nisn_siswa,
        a.nama as nama_guru')
            ->from('siswa a')
            ->join('kelas b', 'a.id_kelas = b.id', 'left')
            ->join('sekolah c', 'b.id_sekolah = c.id', 'left')
            ->where('a.id_user', $id_user)
            ->get()
            ->row_array();
        return $id_sekolah;
    }

    function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('data')['level'];
        $this->id_user = $this->session->userdata('data')['id'];
    }
}
