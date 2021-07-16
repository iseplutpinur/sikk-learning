<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuruModel extends Render_Model
{
    // get data ========================================================================================================
    // dipakai Administrator |
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null, $filter = null)
    {
        // select tabel
        $this->db->select("
        a.nip as id,
        a.nip,
        a.nama,
        a.jenis_kelamin,
        a.alamat,
        e.nama as nama_sekolah,
        g.lev_nama as level_str,
        d.nama as nama_kelas");

        $this->db->from('guru a');
        $this->db->join('users b', 'b.user_id = a.id_user', 'left');
        $this->db->join('guru_kelas c', 'a.nip = c.nip', 'left');
        $this->db->join('kelas d', 'c.id_kelas = d.id', 'left');
        $this->db->join('sekolah e', 'e.id = d.id_sekolah', 'left');
        $this->db->join('role_users f', 'a.id_user = f.role_user_id', 'left');
        $this->db->join('level g', 'g.lev_id = f.role_lev_id', 'left');


        // order by
        if ($order['order'] != null) {
            $columns = $order['columns'];
            $dir = $order['order'][0]['dir'];
            $order = $order['order'][0]['column'];
            $columns = $columns[$order];
            $order_colum = $columns['data'];

            switch ($order_colum) {
                case 'nip':
                    $order_colum = 'a.nip';
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
                case 'level_str':
                    $order_colum = 'g.lev_nama';
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
                a.nip LIKE '%$cari%' or
                a.nama LIKE '%$cari%' or
                a.jenis_kelamin LIKE '%$cari%' or
                e.nama LIKE '%$cari%' or
                d.nama LIKE '%$cari%' or
                a.alamat LIKE '%$cari%' or
                g.lev_nama LIKE '%$cari%' or
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
    public function getUsers($nip)
    {
        $result = $this->db->select('a.id_user, b.id as id_guru_kelas')
            ->from('guru a')
            ->join('guru_kelas b', 'a.nip = b.nip', 'left')
            ->where('a.nip', $nip)
            ->get()
            ->row_array();
        return  $result;
    }

    // dipakai Administrator |
    public function getGuru($nip)
    {
        $result =  $this->db->select("
            a.nip as id,
            a.nip,
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
            f.role_lev_id as level,
            g.lev_nama as level_str,
            b.updated_at")
            ->from('guru a')
            ->join('users b', 'b.user_id = a.id_user', 'left')
            ->join('guru_kelas c', 'a.nip = c.nip', 'left')
            ->join('kelas d', 'c.id_kelas = d.id', 'left')
            ->join('sekolah e', 'e.id = d.id_sekolah', 'left')
            ->join('role_users f', 'a.id_user = f.role_user_id', 'left')
            ->join('level g', 'g.lev_id = f.role_lev_id', 'left')
            ->where('a.nip', $nip)
            ->get()
            ->row_array();
        return $result;
    }

    // insert ==========================================================================================================
    // dipakai Administrator |
    public function insertGuru($nip, $id_user, $id_sekolah, $nama, $tanggal_lahir, $jenis_kelamin, $alamat, $no_telpon, $status)
    {
        $result = $this->db->insert("guru", [
            'nip' => $nip,
            'id_user' => $id_user,
            'id_sekolah' => $id_sekolah,
            'nama' => $nama,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'no_hp' => $no_telpon,
            'alamat' => $alamat,
            'status' => $status,
        ]);

        return $result;
    }

    // dipakai Administrator |
    public function insertGuruKelas($nip, $id_kelas, $status)
    {
        $result = $this->db->insert("guru_kelas", [
            'nip' => $nip,
            'id_kelas' => $id_kelas,
            'status' => $status,
        ]);

        return $result;
    }

    // update ==========================================================================================================
    // dipakai Administrator |
    public function updateGuru($id, $nip, $id_user, $id_sekolah, $nama, $tanggal_lahir, $jenis_kelamin, $alamat, $no_telpon, $status)
    {
        $this->db->where('nip', $id);
        $result = $this->db->update("guru", [
            'nip' => $nip,
            'id_user' => $id_user,
            'id_sekolah' => $id_sekolah,
            'nama' => $nama,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'no_hp' => $no_telpon,
            'alamat' => $alamat,
            'status' => $status,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);

        return $result;
    }

    // dipakai Administrator |
    public function updateGuruKelas($id, $nip, $id_kelas, $status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('guru_kelas', [
            'nip' => $nip,
            'id_kelas' => $id_kelas,
            'status' => $status,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);
        return $result;
    }

    // delete ==========================================================================================================
    // dipakai Administrator |
    public function deleteGuru($id)
    {
        $result = $this->db->delete('guru', ['nip' => $id]);
        return $result;
    }

    // dipakai Administrator |
    public function deleteguruKelas($id)
    {
        $result = $this->db->delete('guru_kelas', ['id' => $id]);
        return $result;
    }

    // cehecking =======================================================================================================
    // dipakai Administrator |
    public function cekNip($nip)
    {
        $result = $this->db->select("nip")
            ->from('guru')
            ->where('nip', $nip)
            ->get()
            ->num_rows();

        // cek di tabel user siapa tahu ada email yang samaa (username)
        if ($result == 0) {
            $result = $this->db->select("user_id")
                ->from('users')
                ->where('user_email', $nip)
                ->get()
                ->num_rows();
        }
        return $result;
    }
}
