<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('kategori')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('kategori')->result();
        }
        $this->response($kontak, 200);
    }


    //Masukan function selanjutnya disini
}
