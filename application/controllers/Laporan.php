<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function index()
    {
        $data['judul'] = "Laporan Penjualan";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }
}
