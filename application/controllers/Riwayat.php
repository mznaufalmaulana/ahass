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
        $this->load->model('M_order');

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

    // mengambil daftar pelanggan
    public function getListCustomer()
    {
        $order_no = $this->input->post('order_no');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $dataKustomer = $this->M_order->get_list_riwayat_customer($order_no, $tgl_mulai, $tgl_akhir);

        echo json_encode($dataKustomer);
    }

    public function detail($id)
    {
        $data['judul'] = "Detail Order";

        $data['dataKustomer'] = $this->M_order->get_data_customer($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('riwayat/detail', $data);
        $this->load->view('templates/footer');
    }
}
