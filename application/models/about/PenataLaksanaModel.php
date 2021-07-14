
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenataLaksanaModel extends Render_Model
{
	function getData(){
		return $this->db->get('konten_about_penata_laksana')->row_array();
	}

	function inputSlider($judul, $deskripsi){
		$row = $this->db->select('id')->get('konten_about_penata_laksana');
        if ($row->num_rows() > 0) {
        	$row = $row->row_array();
            $id = $row['id'];
            $this->db->where('id', $id);
            $exe = $this->db->update('konten_about_penata_laksana', [
                'slider_judul' => $judul,
                'slider_deskripsi' => $deskripsi
            ]);
        } else {
            $exe                         = $this->db->insert('konten_about_penata_laksana', [
                'slider_judul' => $judul,
                'slider_deskripsi' => $deskripsi
            ]);
        }
        return $exe;
	}

}
