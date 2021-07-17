<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends Render_Model
{
    // get data ========================================================================================================
    // dipakai Administrator | Guru Administrator | Guru
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null, $filter = null)
    {

        // jika level Guru Administrator
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

        // jika level Guru
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

        // Jika level Guru Administrator
        if ($this->level == 'Guru Administrator') {
            $this->db->where('e.id', $id_sekolah);
        }

        // Jika level Guru
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

    // dipakai Administrator | Guru Administrator | Guru
    public function getAllSekolah()
    {
        // jika level Guru Administrator atau guru
        $id_sekolah = '';
        if ($this->level == 'Guru Administrator' || $this->level == 'Guru') {
            $id_sekolah = $this->db->select('id_sekolah')
                ->from('guru')
                ->where('id_user', $this->id_user)
                ->get()
                ->row_array();
            $id_sekolah = $id_sekolah != null ? $id_sekolah['id_sekolah'] : null;
        }

        $result = $this->db->select("id, nama")->from('sekolah');
        if ($this->level == 'Guru Administrator' || $this->level == 'Guru') {
            $result->where('id', $id_sekolah);
        }
        $get = $result->get()->result_array();
        return $get;
    }

    // dipakai Administrator | Guru Administrator | Guru
    public function getKelas($id)
    {
        $id_kelas = '';
        if ($this->level == 'Guru') {
            $id_kelas = $this->db->select('b.id_kelas')
                ->from('guru a')
                ->join('guru_kelas b', 'a.nip = b.nip')
                ->where('a.id_user', $this->id_user)
                ->get()
                ->row_array();
            $id_kelas = $id_kelas != null ? $id_kelas['id_kelas'] : null;
        }

        $result = $this->db->select('id, nama as text')->from('kelas');
        if ($this->level == 'Guru') {
            $result->where('id', $id_kelas);
        }
        $result->where('id_sekolah', $id);

        $exe = $result->get()
            ->result_array();
        return $exe;
    }

    // dipakai Administrator | Guru Administrator | Guru
    public function getUsers($nisn)
    {
        $result = $this->db->select('a.id_user, b.id as id_siswa_kelas')
            ->from('siswa a')
            ->join('siswa_kelas b', 'a.nisn = b.nisn', 'left')
            ->where('a.nisn', $nisn)
            ->get()
            ->row_array();
        return  $result;
    }

    // dipakai Administrator | Guru Administrator | Guru
    public function getSiswa($nisn)
    {
        $result =  $this->db->select("
            a.nisn as id,
            a.nisn,
            a.nama,
            a.jenis_kelamin,
            a.alamat,
            a.tanggal_lahir,
            a.status,
            e.id as id_sekolah,
            d.id as id_kelas,
            e.nama as nama_sekolah,
            d.nama as nama_kelas,
            b.user_phone,
            a.created_at,
            b.updated_at")
            ->from('siswa a')
            ->join('users b', 'b.user_id = a.id_user', 'left')
            ->join('siswa_kelas c', 'a.nisn = c.nisn', 'left')
            ->join('kelas d', 'c.id_kelas = d.id', 'left')
            ->join('sekolah e', 'e.id = d.id_sekolah', 'left')
            ->where('a.nisn', $nisn)
            ->get()
            ->row_array();
        return $result;
    }

    // insert ==========================================================================================================
    // dipakai Administrator | Guru Administrator | Guru
    public function insertSiswa($nisn, $id_user, $nama, $tanggal_lahir, $jenis_kelamin, $alamat, $status)
    {
        $result = $this->db->insert("siswa", [
            'nisn' => $nisn,
            'id_user' => $id_user,
            'nama' => $nama,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'status' => $status,
        ]);

        return $result;
    }

    // dipakai Administrator | Guru Administrator | Guru
    public function insertSiswaKelas($nisn, $id_kelas, $status)
    {
        $result = $this->db->insert("siswa_kelas", [
            'nisn' => $nisn,
            'id_kelas' => $id_kelas,
            'status' => $status,
        ]);

        return $result;
    }

    // update ==========================================================================================================
    // dipakai Administrator | Guru Administrator | Guru
    public function updateSiswa($id, $nisn, $id_user, $nama, $tanggal_lahir, $jenis_kelamin, $alamat, $status)
    {
        $this->db->where('nisn', $id);
        $result = $this->db->update("siswa", [
            'nisn' => $nisn,
            'id_user' => $id_user,
            'nama' => $nama,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'status' => $status,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);

        return $result;
    }

    // dipakai Administrator | Guru Administrator | Guru
    public function updateSiswaKelas($id, $nisn, $id_kelas, $status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('siswa_kelas', [
            'nisn' => $nisn,
            'id_kelas' => $id_kelas,
            'status' => $status,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);
        return $result;
    }

    public function konfirmasiSiswa($nisn)
    {
        // Mulai transaksi
        $this->db->trans_start();
        $this->db->where('nisn', $nisn);
        $siswa = $this->db->update('siswa', [
            'status' => 1,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);

        $this->db->where('nisn', $nisn);
        $siswa_kelas = $this->db->update('siswa_kelas', [
            'status' => 1,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);

        $this->db->where('user_email', $nisn);
        $users = $this->db->update('users', [
            'user_status' => 1,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);

        // simpan transaksi
        $this->db->trans_complete();

        return $siswa && $siswa_kelas && $users;
    }

    // delete ==========================================================================================================
    // dipakai Administrator | Guru Administrator | Guru
    public function deleteSiswa($id)
    {
        $result = $this->db->delete('siswa', ['nisn' => $id]);
        return $result;
    }

    // dipakai Administrator | Guru Administrator | Guru
    public function deleteSiswaKelas($id)
    {
        $result = $this->db->delete('siswa_kelas', ['id' => $id]);
        return $result;
    }

    // cehecking =======================================================================================================
    // dipakai Administrator | Guru Administrator | Guru
    public function cekNisn($nisn)
    {
        $result = $this->db->select("nisn")
            ->from('siswa')
            ->where('nisn', $nisn)
            ->get()
            ->num_rows();

        // cek di tabel user siapa tahu ada email yang samaa (username)
        if ($result == 0) {
            $result = $this->db->select("user_id")
                ->from('users')
                ->where('user_email', $nisn)
                ->get()
                ->num_rows();
        }
        return $result;
    }

    function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('data') ? $this->session->userdata('data')['level'] : '';
        $this->id_user = $this->session->userdata('data') ? $this->session->userdata('data')['id'] : '';
    }
}
