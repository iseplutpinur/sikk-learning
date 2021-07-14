<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IdetoModel extends Render_Model
{
    function getData()
    {
        return $this->db->get('konten_about_ideto')->row_array();
    }

    function inputSlider($judul, $deskripsi)
    {
        $row = $this->db->select('id')->get('konten_about_ideto');
        if ($row->num_rows() > 0) {
            $row = $row->row_array();
            $id = $row['id'];
            $dateTimeNow = Date("Y-m-d H:i:s", time());
            $this->db->where('id', $id);
            $exe = $this->db->update('konten_about_ideto', [
                'slider_judul' => $judul,
                'slider_deskripsi' => $deskripsi,
                'updated_at' => $dateTimeNow,
            ]);
            $exe = $exe ? ('Last Update: ' . date('d F Y h:i:s', strtotime($dateTimeNow))) : false;
        } else {
            $exe  = $this->db->insert('konten_about_ideto', [
                'slider_judul' => $judul,
                'slider_deskripsi' => $deskripsi
            ]);
        }
        return $exe;
    }

    function inputProfile($judul, $deskripsi, $list_gambar)
    {
        $row = $this->db->select('id')->get('konten_about_ideto');
        if ($row->num_rows() > 0) {
            $row = $row->row_array();
            $id = $row['id'];
            $dateTimeNow = Date("Y-m-d H:i:s", time());
            $this->db->where('id', $id);
            $exe = $this->db->update('konten_about_ideto', [
                'profil_judul' => $judul,
                'profil_deskripsi' => $deskripsi,
                'profil_gambar' => $list_gambar,
                'updated_at' => $dateTimeNow,
            ]);
            $exe = $exe ? ('Last Update: ' . date('d F Y h:i:s', strtotime($dateTimeNow))) : false;
        } else {
            $exe = $this->db->insert('konten_about_ideto', [
                'profil_judul' => $judul,
                'profil_deskripsi' => $deskripsi,
                'profil_gambar' => $list_gambar
            ]);
        }
        return $exe;
    }

    function inputSejarah($judul, $deskripsi, $list_gambar)
    {
        $row = $this->db->select('id')->get('konten_about_ideto');
        if ($row->num_rows() > 0) {
            $row = $row->row_array();
            $id = $row['id'];
            $dateTimeNow = Date("Y-m-d H:i:s", time());
            $this->db->where('id', $id);
            $exe = $this->db->update('konten_about_ideto', [
                'sejarah_judul' => $judul,
                'sejarah_deskripsi' => $deskripsi,
                'sejarah_gambar' => $list_gambar,
                'updated_at' => $dateTimeNow,
            ]);
            $exe = $exe ? ('Last Update: ' . date('d F Y h:i:s', strtotime($dateTimeNow))) : false;
        } else {
            $exe = $this->db->insert('konten_about_ideto', [
                'sejarah_judul' => $judul,
                'sejarah_deskripsi' => $deskripsi,
                'sejarah_gambar' => $list_gambar,
            ]);
        }
        return $exe;
    }
}
