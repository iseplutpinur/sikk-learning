<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarSekolahModel extends Render_Model
{
    // dipakai Administrator |
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null)
    {
        // select tabel
        $this->db->select("*,
        IF(sekolah.status = '0' , 'Tidak Aktif', IF(sekolah.status = '1' , 'Aktif', 'Tidak Diketahui')) as status_str");
        $this->db->from("sekolah");

        // order by
        if ($order['order'] != null) {
            $columns = $order['columns'];
            $dir = $order['order'][0]['dir'];
            $order = $order['order'][0]['column'];
            $columns = $columns[$order];

            $order_colum = $columns['data'];
            $this->db->order_by($order_colum, $dir);
        }

        // initial data table
        if ($draw == 1) {
            $this->db->limit(10, 0);
        }

        // pencarian
        if ($cari != null) {
            $this->db->where("(nama LIKE '%$cari%' or alamat LIKE '%$cari%' or no_telpon LIKE '%$cari%' or created_at LIKE '%$cari%' or updated_at LIKE '%$cari%' or IF(sekolah.status = '0' , 'Tidak Aktif', IF(sekolah.status = '1' , 'Aktif', 'Tidak Diketahui')) LIKE '%$cari%')");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    // dipakai Administrator |
    public function getSekolah($id)
    {
        $result = $this->db->get_where("sekolah", ['id' => $id])->row_array();
        return $result;
    }

    // dipakai Administrator |
    public function getSekolahDetail($id)
    {
        $result = $this->db
            ->select("
                a.*,
                (select count(*) from kelas b where b.id_sekolah = a.id ) as jumlah_kelas,
                sum((select count(*) from guru_kelas d where d.id_kelas = c.id )) as jumlah_guru,
                sum((select count(*) from siswa d where d.id_kelas = c.id )) as jumlah_siswa,
                (select count(*) from daftar_project e where e.id_sekolah = a.id ) as jumlah_project
            ")
            ->from('sekolah a')
            ->join('kelas c', 'c.id_sekolah = a.id')
            ->where('a.id', $id)
            ->get()
            ->row_array();
        return $result;
    }

    // dipakai Administrator |
    public function insert($npsn, $nama, $alamat, $no_telepon, $status)
    {
        $result = $this->db->insert("sekolah", [
            'npsn' => $npsn,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telepon,
            'status' => $status,
        ]);

        return $result;
    }

    // dipakai Administrator |
    public function update($id, $npsn, $nama, $alamat, $no_telepon, $status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('sekolah', [
            'npsn' => $npsn,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telepon,
            'status' => $status,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);
        return $result;
    }

    // dipakai Administrator |
    public function delete($id)
    {
        $result = $this->db->delete('sekolah', ['id' => $id]);
        return $result;
    }

    // dipakai administrator |
    public function cekNpsn($npsn)
    {
        $result = $this->db->select("npsn")->from("sekolah")->where("npsn", $npsn)->get()->num_rows();
        return $result;
    }

    // dipakai Guru Administrator | Guru
    public function getIdSekolahByIdUser($id)
    {
        $id_sekolah = $this->db->select('d.id as id_sekolah, d.nama as nama_sekolah, c.id as id_kelas,c.nama as nama_kelas, a.nip as nip_guru, a.nama as nama_guru')
            ->from('guru a')
            ->join('guru_kelas b', 'a.nip = b.nip', 'left')
            ->join('kelas c', 'b.id_kelas = c.id', 'left')
            ->join('sekolah d', 'c.id_sekolah = d.id', 'left')
            ->where('a.id_user', $id)
            ->get()
            ->row_array();
        return $id_sekolah;
    }

    // dipakai Registrasi
    public function cari($key)
    {
        $this->db->select("a.id as id, concat('( ', npsn, ' ) ', nama) as text");
        $this->db->from('sekolah a');
        $this->db->where("(nama LIKE '%$key%' or npsn LIKE '%$key%' or alamat LIKE '%$key%' or no_telpon LIKE '%$key%')");
        $this->db->where("status", '1');
        return $this->db->get()->result_array();
    }
}
