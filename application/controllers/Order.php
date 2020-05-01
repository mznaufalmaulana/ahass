<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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
        $data['judul'] = "Order";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail()
    {
        $data['judul'] = "Detail Order";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('order/detail', $data);
        $this->load->view('templates/footer');
    }
}
