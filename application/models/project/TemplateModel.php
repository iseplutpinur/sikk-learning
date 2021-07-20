<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TemplateModel extends Render_Model
{

    // dipakai Administrator |
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

        // select tabel
        $this->db->select("
            a.id,
            a.judul,
            a.created_at,
            a.updated_at,
            b.nama as nama_sekolah,
            a.status
        ");

        $this->db->from('templates a');
        $this->db->join('sekolah b', 'a.id_sekolah = b.id', 'left');
        $this->db->where('a.status <> 0');

        // Jika level Guru Administrator by sekolah
        if ($this->level == 'Guru Administrator') {
            $this->db->where('b.id', $id_sekolah);
        }

        // order by
        if ($order['order'] != null) {
            $columns = $order['columns'];
            $dir = $order['order'][0]['dir'];
            $order = $order['order'][0]['column'];
            $columns = $columns[$order];
            $order_colum = $columns['data'];

            switch ($order_colum) {
                case 'judul':
                    $order_colum = 'a.judul';
                    break;
                case 'created_at':
                    $order_colum = 'a.created_at';
                    break;
                case 'updated_at':
                    $order_colum = 'a.updated_at';
                    break;
                case 'status':
                    $order_colum = 'a.status';
                    break;
                case 'nama_sekolah':
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
                $this->db->where('b.id', $filter['id_sekolah']);
            }
            // // by status
            // if ($filter['status'] != '') {
            //     $this->db->where('a.status', $filter['status']);
            // }
        }

        // pencarian
        if ($cari != null) {
            $this->db->where("(
                a.id LIKE '%$cari%' or
                a.judul LIKE '%$cari%' or
                a.created_at LIKE '%$cari%' or
                a.updated_at LIKE '%$cari%' or
                b.nama LIKE '%$cari%' or
                a.status LIKE '%$cari%'
                )");
        }

        // pagination
        if ($show != null && $start != null) {
            $this->db->limit($show, $start);
        }

        $result = $this->db->get();
        return $result;
    }

    // Dipakai Administrator |
    public function tambahTemplate($id_sekolah = null)
    {
        if ($this->level == "Administrator") {
            $id_sekolah = 0;
        }
        // get darft
        $row = $this->db
            ->select('id')
            ->from('templates')
            ->where([
                'id_sekolah' => $id_sekolah,
                'status' => '0'
            ])
            ->get()
            ->row_array();
        if ($row != null) {
            return $row;
        } else {
            // insert
            $this->db->insert('templates', [
                'id_sekolah' => $id_sekolah,
                'status' => '0'
            ]);
            $result = $this->db->insert_id();
            return ['id' => $result];
        }
    }

    // Dipakai Administrator |
    public function simpanData($id_template, $id_sekolah, $judul, $keterangan, $simpan_audio, $simpan_image)
    {
        $tipe = $this->input->post("tipe");
        $data = [
            'id_sekolah' => $id_sekolah,
            'judul' => $judul,
            'keterangan' => $keterangan,
            'suara' => $simpan_audio,
            'gambar' => $simpan_image,
            'status' => 1,
        ];
        if ($tipe) {
            $data['updated_at'] = Date("Y-m-d H:i:s", time());
        } else {
            $data['created_at'] = Date("Y-m-d H:i:s", time());
        }

        $this->db->where('id', $id_template);
        $result = $this->db->update('templates', $data);
        return $result;
    }

    // Dipakai Guru | Guru Administrator
    public function getTemplate($id)
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

        // select tabel
        $this->db->select("
            a.id,
            a.judul,
            a.created_at,
            a.updated_at,
            b.nama as nama_sekolah,
            b.id as id_sekolah,
            a.keterangan,
            a.status
        ");

        $this->db->from('templates a');
        $this->db->join('sekolah b', 'a.id_sekolah = b.id', 'left');
        $this->db->where('a.status <> 0');
        $this->db->where('a.id', $id);

        // Jika level Guru Administrator by sekolah
        if ($this->level == 'Guru Administrator') {
            $this->db->where('b.id', $id_sekolah);
        }

        $result = $this->db->get()->row_array();
        return $result;
    }

    // Dipakai Guru | Guru Administrator
    public function delete($id)
    {
        $result = $this->db->delete('templates', ['id' => $id]);
        return $result;
    }

    // Dipakai Guru Administraor
    public function getSekolahByIdUser($id)
    {
        $result = $this->db->select('a.id_sekolah, b.nama')
            ->from('guru a')
            ->join("sekolah b", 'a.id_sekolah = b.id')
            ->where('id_user', $this->id_user)
            ->get()
            ->row_array();
        return $result;
    }

    function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('data')['level'];
        $this->id_user = $this->session->userdata('data')['id'];
    }
}
