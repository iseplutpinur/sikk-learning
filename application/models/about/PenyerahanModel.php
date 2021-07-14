<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenyerahanModel extends Render_Model
{
	function getData(){
		return $this->db->get('konten_about_penyerahan')->row_array();
	}
	
	function inputData($slider_judul, $slider_deskripsi, $judul_1, $deskripsi_1, $judul_2, $deskripsi_2, $judul_3, $deskripsi_3, $judul_4, $deskripsi_4, $judul_5, $deskripsi_5, $judul_6, $deskripsi_6){
        $row = $this->db->select('id')->get('konten_about_penyerahan');
        if ($row->num_rows() > 0) {
            $row = $row->row_array();
            $id = $row['id'];
            $this->db->where('id', $id);
            $exe = $this->db->update('konten_about_penyerahan', [
                'slider_judul'      => $slider_judul,
                'slider_deskripsi'  => $slider_deskripsi,
                'judul_1'           => $judul_1,
                'deskripsi_1'       => $deskripsi_1, 
                'judul_2'           => $judul_2,
                'deskripsi_2'       => $deskripsi_2, 
                'judul_3'           => $judul_3,
                'deskripsi_3'       => $deskripsi_3, 
                'judul_4'           => $judul_4,
                'deskripsi_4'       => $deskripsi_4, 
                'judul_5'           => $judul_5,
                'deskripsi_5'       => $deskripsi_5, 
                'judul_6'           => $judul_6,
                'deskripsi_6'       => $deskripsi_6
            ]);
        } else {
            $exe                         = $this->db->insert('konten_about_penyerahan', [
                'slider_judul'      => $slider_judul,
                'slider_deskripsi'  => $slider_deskripsi,
                'judul_1'           => $judul_1,
                'deskripsi_1'       => $deskripsi_1, 
                'judul_2'           => $judul_2,
                'deskripsi_2'       => $deskripsi_2, 
                'judul_3'           => $judul_3,
                'deskripsi_3'       => $deskripsi_3, 
                'judul_4'           => $judul_4,
                'deskripsi_4'       => $deskripsi_4, 
                'judul_5'           => $judul_5,
                'deskripsi_5'       => $deskripsi_5, 
                'judul_6'           => $judul_6,
                'deskripsi_6'       => $deskripsi_6
            ]);
        }
        return $exe;
	}
}
