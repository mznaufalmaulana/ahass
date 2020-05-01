<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
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
