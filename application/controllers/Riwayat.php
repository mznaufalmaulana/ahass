<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');

        if (!isset($_SESSION['id'])) {
            redirect('Auth/');
        }
    }

    public function index()
    {
        $data['judul'] = "Riwayat";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('riwayat/index', $data);
        $this->load->view('templates/footer');
    }
}
