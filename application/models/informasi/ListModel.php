<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListModel extends Render_Model
{
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null)
    {
        // select tabel
        $this->db->select("a.*, b.nama as kategori, b.id as id_kategori");
        $this->db->from("informasi a");
        $this->db->join('kategori b', 'a.id_kategori = b.id', 'left');

        // order by
        if ($order['order'] != null) {
            $columns = $order['columns'];
            $dir = $order['order'][0]['dir'];
            $order = $order['order'][0]['column'];
            $columns = $columns[$order];

            $order_colum = $columns['data'];
            $order_colum = $order_colum == 'kategori' ? 'b.nama' : 'a.' . $order_colum;
            $this->db->order_by($order_colum, $dir);
        }

        // initial data table
        if ($draw == 1) {
            $this->db->limit(10, 0);
        }

        // pencarian
        if ($cari != null) {
            $this->db->where("(
                a.judul LIKE '%$cari%' or
                a.deskripsi LIKE '%$cari%' or
                a.tanggal LIKE '%$cari%' or
                a.penulis LIKE '%$cari%' or
                b.nama LIKE '%$cari%' or
                a.status LIKE '%$cari%' or
                a.created_at LIKE '%$cari%' or
                a.updated_at LIKE '%$cari%'
                )");
        }

        $this->db->where("a.status <> 'Darft'");

        // pagination
        if ($show == null && $start == null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    public function getListKategori()
    {
        $result = $this->db->select('id,nama')->from('kategori')->get()->result_array();
        return $result;
    }

    public function delete($id)
    {
        $result = $this->db->delete('informasi', ['id' => $id]);
        return $result;
    }
    public function newInformasi()
    {
        // get darft
        $row = $this->db->select('*')->from('informasi')->where('status', 'Darft')->get()->row_array();
        if ($row != null) {
            return $row;
        } else {
            // insert
            $this->db->insert('informasi', ['judul' => '']);
            $result = $this->db->insert_id();
            return ['id' => $result];
        }
    }

    public function uploadImage($path, $id)
    {
        // cek directory
        if (!is_dir($path)) {
            mkdir($path, 0755, TRUE);
        }
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|PNG|JPEG';
        $config['file_name']            = $id;
        $config['overwrite']            = true;
        $config['max_size']             = 8024;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('thumbnail')) {
            return $this->upload->data("file_name");
        } else {
            $error = array('error' => $this->upload->display_errors());

            return $error;
        }
    }

    public function input($id, $judul, $kategori, $penulis, $tanggal, $deskripsi, $list_gambar)
    {

        $this->db->where('id', $id);
        $result = $this->db->update('informasi', [
            'judul' => $judul,
            'id_kategori' => $kategori,
            'deskripsi' => $deskripsi,
            'gambar' => $list_gambar,
            'penulis' => $penulis,
            'status' => 'Disimpan',
            'tanggal' => $tanggal,
            'created_at' => Date("Y-m-d H:i:s", time())
        ]);
        return $result;
    }
}
