<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SiswaModel extends Render_Model
{
    // dipakai Administrator |
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null, $filter = null)
    {
        // select tabel
        $this->db->select("a.id,
        a.id_sekolah,
        a.nama,
        b.nama as nama_sekolah,
        (select count(*) from siswa_kelas c where c.id_kelas = a.id) as jml_murid,
        a.status,
        IF(a.status = '0' , 'Tidak Aktif', IF(a.status = '1' , 'Aktif', 'Tidak Diketahui')) as status_str");

        $this->db->from('kelas a');
        $this->db->join('sekolah b', 'a.id_sekolah = b.id');

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
        $result = $this->db->get_where("kelas", ['id' => $id])->row_array();
        return $result;
    }

    // dipakai Administrator |
    public function insert($nama, $sekolah, $status)
    {
        $result = $this->db->insert("kelas", [
            'id_sekolah' => $sekolah,
            'nama' => $nama,
            'status' => $status,
        ]);

        return $result;
    }

    // dipakai Administrator |
    public function update($id, $nama, $sekolah, $status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('kelas', [
            'id_sekolah' => $sekolah,
            'nama' => $nama,
            'status' => $status,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);
        return $result;
    }

    // dipakai Administrator |
    public function delete($id)
    {
        $result = $this->db->delete('kelas', ['id' => $id]);
        return $result;
    }
}
