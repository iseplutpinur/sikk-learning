<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KontenModel extends Render_Model
{
    function getData()
    {
        return $this->db->get('konten_home')->row_array();
    }

    function inputData($slider_judul, $slider_deskripsi, $informasi_judul, $informasi_deskripsi, $informasi_gambar)
    {
        $row = $this->db->select('id')->get('konten_home');
        if ($row->num_rows() > 0) {
            $row = $row->row_array();
            $id = $row['id'];
            $this->db->where('id', $id);
            $dateTimeNow = Date("Y-m-d H:i:s", time());
            $exe = $this->db->update('konten_home', [
                'slider_judul'          => $slider_judul,
                'slider_deskripsi'      => $slider_deskripsi,
                'informasi_judul'       => $informasi_judul,
                'informasi_deskripsi'   => $informasi_deskripsi,
                'informasi_gambar'      => $informasi_gambar,
                'updated_at'            => $dateTimeNow,
            ]);
            $exe = $exe ? ('Last Update: ' . date('d F Y h:i:s', strtotime($dateTimeNow))) : false;
        } else {
            $exe                        = $this->db->insert('konten_home', [
                'slider_judul'          => $slider_judul,
                'slider_deskripsi'      => $slider_deskripsi,
                'informasi_judul'       => $informasi_judul,
                'informasi_deskripsi'   => $informasi_deskripsi,
                'informasi_gambar'      => $informasi_gambar
            ]);
        }
        return $exe;
    }
}
