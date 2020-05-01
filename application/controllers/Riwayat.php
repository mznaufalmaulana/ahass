<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Riwayat";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('riwayat/index', $data);
        $this->load->view('templates/footer');
    }
}
