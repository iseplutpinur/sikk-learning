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
        $session = $this->sesion->cek_session_return();
        if ($session) {
            // Page Settings
            $this->title = 'Dashboard';
            $this->title_show = false;
            $this->navigation = ['Memory Game'];

            // Breadcrumb setting
            $this->breadcrumb_1 = 'Dashboard';
            $this->breadcrumb_1_url = base_url();
            $this->breadcrumb_2 = 'Game';
            $this->breadcrumb_2_url = '#';
            $this->breadcrumb_3 = 'Dashboard';
            $this->breadcrumb_3_url = '#';
            $this->breadcrumb_show = false;

            $this->content = 'game/memory-game';
            // Send data to view
            $this->render();
        } else {
            $this->load->view('templates/contents/game/memory-game-exe');
        }
    }


    public function memoryGameDisplay()
    {
        $this->load->view('templates/contents/game/memory-game-exe');
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
        }
    }
}
