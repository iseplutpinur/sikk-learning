<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KontenModel extends Render_Model
{
	function getData(){
		return $this->db->get('konten_arsip')->row_array();
	}
	
	function inputData($judul, $deskripsi){
        $row = $this->db->select('id')->get('konten_arsip');
        if ($row->num_rows() > 0) {
            $row = $row->row_array();
            $id = $row['id'];
            $this->db->where('id', $id);
            $exe = $this->db->update('konten_arsip', [
                'slider_judul' => $judul,
                'slider_deskripsi' => $deskripsi
            ]);
        } else {
            $exe                         = $this->db->insert('konten_arsip', [
                'slider_judul' => $judul,
                'slider_deskripsi' => $deskripsi
            ]);
        }
        return $exe;
	}

}
