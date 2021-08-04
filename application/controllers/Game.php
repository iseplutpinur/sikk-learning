<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Game extends Render_Controller
{
    // Dipakai Administrator
    public function index()
    {
    }

    public function memoryGame()
    {
    }

    public function __construct()
    {
        parent::__construct();
        // Cek session
        $session = $this->sesion->cek_session_return();
        if ($session) {
            $this->default_template = 'templates/dashboard';
            $this->load->library('plugin');
            $this->load->helper('url');
            // model
            $this->load->model("DashboardModel", 'dashbrd');
        } else {
        }
    }
}
