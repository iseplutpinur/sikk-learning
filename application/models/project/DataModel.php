<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataModel extends Render_Model
{

    // Dipkakai Administrator | Guru Administrator | Guru
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

        // jika level Siswa get kelas
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
        $this->db->where('a.status <> 0');

        // Jika level Guru Administrator by sekolah
        if ($this->level == 'Guru Administrator') {
            $this->db->where('d.id', $id_sekolah);
        }

        // Jika level Guru by kelas
        if ($this->level == 'Guru') {
            $this->db->where('c.id', $id_kelas);
            $this->db->where('b.nip', $nip_guru);
        }

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
                c.nama LIKE '%$cari%' or
                a.judul LIKE '%$cari%' or
                b.nama LIKE '%$cari%'
                )");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    // Dipkakai Administrator | Guru Administrator | Guru
    public function tambahProject($id_sekolah = null, $id_kelas = null, $nip_guru = null)
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

    // Dipkakai Administrator | Guru Administrator | Guru
    public function simpanData($id_project, $id_sekolah, $id_kelas, $nip, $judul, $pendahuluan, $deskripsi, $tujuan, $link_sumber, $jumlah_aktifitas, $simpan_audio, $simpan_image)
    {
        $tipe = $this->input->post("tipe");
        $data = [
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
        ];
        if ($tipe) {
            $data['updated_at'] = Date("Y-m-d H:i:s", time());
        } else {
            $data['created_at'] = Date("Y-m-d H:i:s", time());
        }

        $this->db->where('id', $id_project);
        $result = $this->db->update('daftar_project', $data);
        return $result;
    }

    // Dipkakai Administrator | Guru Administrator | Guru | Siswa
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

        // jika level Siswa get kelas
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

        // Jika level Siswa by kelas
        if ($this->level == 'Siswa') {
            $this->db->where('d.id', $id_sekolah);
        }

        $result = $this->db->get()->row_array();
        return $result;
    }

    // Dipkakai Administrator | Guru Administrator | Guru
    public function getProjectComplete($id)
    {
        $result = $this->db->get_where("daftar_project", ['id' => $id])->row_array();
        return $result;
    }

    // Dipkakai Administrator | Guru Administrator | Guru
    public function delete($id)
    {
        $result = $this->db->delete('daftar_project', ['id' => $id]);
        $result1 = $this->db->delete('daftar_project_detail', ['id_daftar_project' => $id]);
        return $result && $result1;
    }

    function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('data')['level'];
        $this->id_user = $this->session->userdata('data')['id'];
    }
}
