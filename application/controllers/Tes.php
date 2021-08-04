<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tes extends Render_Controller
{
    //create the folder if it's not exists
    public function index()
    {
        $path = "images/profile";
        if (!is_dir($path)) {
            $result = mkdir($path, 0755, TRUE);
        }
    }

    // list file in dir
    public function list_dir()
    {
        $this->load->helper('directory');
        $files = directory_map('./images/about/ideto/', FALSE, TRUE);
        var_dump($files);
        die;
        foreach ($files as $file) {
            if (is_string($file)) {
                echo $file[1];
            }
        }
    }
}
