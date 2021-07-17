<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataModel extends Render_Model
{

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

    function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('data')['level'];
        $this->id_user = $this->session->userdata('data')['id'];
    }
}
