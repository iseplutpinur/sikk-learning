<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelashModel extends Render_Model
{
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null)
    {
        // select tabel
        $this->db->select("*");
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
            $this->db->where("(a.nama LIKE '%$cari%' or a.alamat LIKE '%$cari%' or no_telpon LIKE '%$cari%' or created_at LIKE '%$cari%' or updated_at LIKE '%$cari%')");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    public function getSekolah($id)
    {
        $result = $this->db->get_where("sekolah", ['id' => $id])->row_array();
        return $result;
    }

    public function insert($nama, $alamat, $no_telepon, $status)
    {
        $result = $this->db->insert("sekolah", [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telepon,
            'status' => $status,
        ]);

        return $result;
    }

    public function update($id, $nama, $alamat, $no_telepon, $status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('sekolah', [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telepon,
            'status' => $status,
            'updated_at' => Date("Y-m-d H:i:s", time())
        ]);
        return $result;
    }

    public function delete($id)
    {
        $result = $this->db->delete('sekolah', ['id' => $id]);
        return $result;
    }
}
