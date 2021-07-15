<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends Render_Model
{
    // get data ========================================================================================================
    // dipakai Administrator |
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null, $filter = null)
    {
        // select tabel
        $this->db->select("
        a.nisn as id,
        a.nisn,
        a.nama,
        a.jenis_kelamin,
        a.alamat,
        e.nama as nama_sekolah,
        d.nama as nama_kelas");

        $this->db->from('siswa a');
        $this->db->join('users b', 'b.user_id = a.id_user', 'left');
        $this->db->join('siswa_kelas c', 'a.nisn = c.nisn', 'left');
        $this->db->join('kelas d', 'c.id_kelas = d.id', 'left');
        $this->db->join('sekolah e', 'e.id = d.id_sekolah', 'left');


        // order by
        if ($order['order'] != null) {
            $columns = $order['columns'];
            $dir = $order['order'][0]['dir'];
            $order = $order['order'][0]['column'];
            $columns = $columns[$order];
            $order_colum = $columns['data'];
            $order_colum = $order_colum == 'nama' ? 'a.' . $order_colum : $order_colum;
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
                $this->db->where('b.id', $filter['id_sekolah']);
            }

            // by status
            if ($filter['status'] != '') {
                $this->db->where('a.status', $filter['status']);
            }
        }

        // pencarian
        if ($cari != null) {
            $this->db->where("(
                a.id_sekolah LIKE '%$cari%' or
                a.nama LIKE '%$cari%' or
                b.nama LIKE '%$cari%' or
                (select count(*) from siswa_kelas c where c.id_kelas = a.id) LIKE '%$cari%' or
                IF(a.status = '0' , 'Tidak Aktif', IF(a.status = '1' , 'Aktif', 'Tidak Diketahui')) LIKE '%$cari%')");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    // dipakai Administrator |
    public function getAllSekolah()
    {
        $result = $this->db->select("id, nama")->from('sekolah')->get()->result_array();
        return $result;
    }

    // dipakai Administrator |
    public function getKelas($id)
    {
        $result = $this->db->select('id, nama as text')
            ->from('kelas')
            ->where('id_sekolah', $id)
            ->get()
            ->result_array();
        return $result;
    }

    // dipakai Administrator |
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

    // dipakai Administrator |
    public function getSiswa($id)
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
            b.user_phone")
            ->from('siswa a')
            ->join('users b', 'b.user_id = a.id_user', 'left')
            ->join('siswa_kelas c', 'a.nisn = c.nisn', 'left')
            ->join('kelas d', 'c.id_kelas = d.id', 'left')
            ->join('sekolah e', 'e.id = d.id_sekolah', 'left')
            ->where('a.nisn', $id)
            ->get()
            ->row_array();
        return $result;
    }

    // insert ==========================================================================================================
    // dipakai Administrator |
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

    // dipakai Administrator |
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
    // dipakai Administrator |
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

    // dipakai Administrator |
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

    // delete ==========================================================================================================
    // dipakai Administrator |
    public function deleteSiswa($id)
    {
        $result = $this->db->delete('siswa', ['nisn' => $id]);
        return $result;
    }

    // dipakai Administrator |
    public function deleteSiswaKelas($id)
    {
        $result = $this->db->delete('siswa_kelas', ['id' => $id]);
        return $result;
    }

    // cehecking =======================================================================================================
    // dipakai Administrator |
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
}
