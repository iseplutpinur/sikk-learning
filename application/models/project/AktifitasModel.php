<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AktifitasModel extends Render_Model
{
    // Dipakai Guru |
    public function getListAktifitas($id)
    {
        // get Jumlah aktifitas dari tabel daftar_project
        $jml_aktifitas = $this->db->select("jumlah_aktifitas")->from("daftar_project")->where("id", $id)->get()->row_array();
        $daftar_project_detail = $this->db->select("*")->from("daftar_project_detail")->where("id_daftar_project", $id)->get();

        // bandingkan jika kurang maka buat lagi
        $jml_yang_ada = $daftar_project_detail->num_rows();
        $jml_di_tabel = $jml_aktifitas['jumlah_aktifitas'];
        $kurang = $jml_di_tabel - $jml_yang_ada;
        $results = [];
        if ($jml_yang_ada < $jml_di_tabel) {
            for ($i = 0; $i < $kurang; $i++) {
                $results[] = $this->creteAktifitas($id);
            }
        }
        $results = array_merge($daftar_project_detail->result_array(), $results);
        return $results;
    }

    // Dipakai getListAktifitas |
    private function creteAktifitas($id_daftar_project)
    {
        // insert
        $this->db->insert('daftar_project_detail', [
            'id_daftar_project' => $id_daftar_project,
            'status' => '0'
        ]);
        $result = $this->db->insert_id();
        return ['id' => $result, 'id_daftar_project' => $id_daftar_project];
    }
}
