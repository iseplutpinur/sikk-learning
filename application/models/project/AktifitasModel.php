<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AktifitasModel extends Render_Model
{
    // Dipakai Guru |
    public function getListAktifitas($id)
    {
        // get Jumlah aktifitas dari tabel daftar_project
        $jml_aktifitas = $this->db
            ->select("jumlah_aktifitas")
            ->from("daftar_project")
            ->where("id", $id)
            ->get()
            ->row_array();

        $daftar_project_detail = $this->db
            ->select("*")
            ->from("daftar_project_detail")
            ->where("id_daftar_project", $id)
            ->where("status", 1)
            ->get();

        // bandingkan jika kurang maka buat lagi
        $jml_yang_ada = $daftar_project_detail->num_rows();
        $jml_di_tabel = $jml_aktifitas['jumlah_aktifitas'];
        $kurang = $jml_di_tabel - $jml_yang_ada;
        $results = [];
        if ($jml_yang_ada < $jml_di_tabel) {
            for ($i = 0; $i < $kurang; $i++) {
                $results[] = $this->creteAktifitas($id, 1);
            }
        }
        $results = array_merge($daftar_project_detail->result_array(), $results);
        return $results;
    }

    // Dipakai Guru |
    public function getListAktifitasForDelete($id_project)
    {
        $lists = $this->db
            ->select("id")
            ->from("daftar_project_detail")
            ->where("id_daftar_project", $id_project)
            ->get()
            ->result_array();
        return $lists;
    }

    public function deleteAktifitas($id)
    {
        $result = $this->db->delete('daftar_project_detail', ['id' => $id]);
        return $result;
    }

    public function updateJumlahAktifitas($id_project, $jumlah_aktifitas)
    {
        $data = [
            'jumlah_aktifitas' => $jumlah_aktifitas
        ];
        $this->db->where('id', $id_project);
        $result = $this->db->update('daftar_project', $data);
        return $result;
    }

    // Dipakai getListAktifitas | Administrator
    public function creteAktifitas($id_daftar_project, $status = 0)
    {
        // insert
        $this->db->insert('daftar_project_detail', [
            'id_daftar_project' => $id_daftar_project,
            'status' => $status
        ]);
        $result = $this->db->insert_id();
        return ['id' => $result, 'id_daftar_project' => $id_daftar_project];
    }

    // Dipakai Administrator |
    public function getListTemplates($id_sekolah)
    {
        $result  = $this->db->select("id, judul")->from("templates")->where("id_sekolah", $id_sekolah)->get()->result_array();
        return $result;
    }

    // Dipkakai Administrator | Guru Administrator | Guru
    public function simpanData($id_aktifitas, $judul, $jenis_upload, $nilai, $template, $naskah, $detail, $lembar_kerja, $simpan_audio, $simpan_image)
    {
        $tipe = $this->input->post("tipe");
        $data = [
            'judul' => $judul,
            'jenis_upload' => $jenis_upload,
            'nilai' => $nilai,
            'naskah' => $naskah,
            'detail' => $detail,
            'lembar_kerja' => $lembar_kerja,
            'id_template' => $template,
            'suara' => $simpan_audio,
            'gambar' => $simpan_image,
            'status' => 1
        ];
        if ($tipe) {
            $data['updated_at'] = Date("Y-m-d H:i:s", time());
        } else {
            $data['created_at'] = Date("Y-m-d H:i:s", time());
        }

        $this->db->where('id', $id_aktifitas);
        $result = $this->db->update('daftar_project_detail', $data);
        return $result;
    }

    // Dipakai Administrator |
    public function getProject($id)
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

        // jika level Guru get kelas
        $id_kelas = '';
        $nip_guru = '';
        if ($this->level == 'Guru') {
            // get kelas guru itu
            $id_kelas = $this->db->select('b.id_kelas, a.nip')
                ->from('guru a')
                ->join('guru_kelas b', 'a.nip = b.nip')
                ->where('a.id_user', $this->id_user)
                ->get()
                ->row_array();
            $nip_guru = $id_kelas != null ? $id_kelas['nip'] : null;
            $id_kelas = $id_kelas != null ? $id_kelas['id_kelas'] : null;
        }

        // select tabel
        $this->db->select("
                a.id,
                a.judul,
                a.pendahuluan,
                a.deskripsi,
                a.tujuan,
                a.jumlah_aktifitas,
                a.link_sumber,
                a.status,
                d.nama as nama_sekolah,
                d.id as id_sekolah,
                c.nama as nama_kelas,
                c.id as id_kelas,
                b.nama as nama_guru,
                b.nip as nip_guru,
                a.created_at,
                a.updated_at,
            ");

        $this->db->from('daftar_project a');
        $this->db->join('guru b', 'a.nip_guru = b.nip', 'left');
        $this->db->join('kelas c', 'a.id_kelas = c.id', 'left');
        $this->db->join('sekolah d', 'a.id_sekolah = d.id', 'left');
        $this->db->where('a.id', $id);

        // Jika level Guru Administrator by sekolah
        if ($this->level == 'Guru Administrator') {
            $this->db->where('d.id', $id_sekolah);
        }

        // Jika level Guru by kelas
        if ($this->level == 'Guru') {
            $this->db->where('c.id', $id_kelas);
            $this->db->where('b.nip', $nip_guru);
        }

        $result = $this->db->get()->row_array();
        return $result;
    }

    function __construct()
    {
        parent::__construct();
        $this->level = $this->session->userdata('data')['level'];
        $this->id_user = $this->session->userdata('data')['id'];
    }
}
