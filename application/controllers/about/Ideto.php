<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ideto extends Render_Controller
{

    public function index()
    {
        $this->content = 'about/ideto';
        $this->data['about'] = $this->db->get("konten_about_ideto")->row_array();
        $this->navigation = ['about', 'about-ideto'];
        $this->title = 'About | IDETO.co.id';
        $this->render();
    }

    function __construct()
    {
        parent::__construct();
        $this->default_template = 'templates/landing_page';
        $this->load->library('plugin');
        $this->load->helper('url');
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */