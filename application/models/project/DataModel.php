<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataModel extends Render_Model
{    // dipakai Administrator |
    public function getAllData($draw = null, $show = null, $start = null, $cari = null, $order = null)
    {
        // select tabel
        $this->db->select("*, IF(sekolah.status = '0' , 'Tidak Aktif', IF(sekolah.status = '1' , 'Aktif', 'Tidak Diketahui')) as status_str");
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
    public function simpanData($id_project, $id_sekolah, $id_kelas, $nip,  $judul, $deskripsi, $tujuan, $link_sumber, $jumlah_aktifitas, $simpan_audio, $simpan_image)
    {
        $this->db->where('id', $id_project);
        $result = $this->db->update('daftar_project', [
            'id_sekolah' => $id_sekolah,
            'id_kelas' => $id_kelas,
            'nip_guru' => $nip,
            'judul' => $judul,
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
