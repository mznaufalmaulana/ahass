<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Pengguna";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pengguna/index', $data);
        $this->load->view('templates/footer');
    }
}
