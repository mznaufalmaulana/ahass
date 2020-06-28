<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('M_laporan');

        if (!isset($_SESSION['id'])) {
            redirect('Auth/');
        }
    }

    public function index()
    {
        $data['judul'] = "Laporan Penjualan";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }

    // mengambil data pesanan
    public function getListPesanan()
    {
        $nama_produk = $this->input->post('nama_produk');
        $start_month = $this->input->post('start_month');
        $end_month = $this->input->post('end_month');

        $dataPesanan = $this->M_laporan->get_data_laporan($nama_produk, $start_month, $end_month);

        echo json_encode($dataPesanan);
    }
}
