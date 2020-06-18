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

        $this->db->select("p.nama_produk AS nama_produk");
        $this->db->select("(select ifnull(sum(dp.jumlah),0) from data_pesanan dp where dp.id_produk = p.id AND dp.status = 3 AND dp.tanggal_pembelian BETWEEN '" . $start_month . "' AND '" . $end_month . "' group by dp.id_produk) AS total_jual");
        $this->db->select("(select ifnull(sum(dp.total_harga),0) from data_pesanan dp where dp.id_produk = p.id AND dp.status = 3 AND dp.tanggal_pembelian BETWEEN '" . $start_month . "' AND '" . $end_month . "' group by dp.id_produk) AS total_pemasukan");
        $this->db->from('produk p');
        $this->db->join('data_pesanan dp', 'dp.id_produk = p.id');

        if (strlen($nama_produk) != 0) {
            $this->db->like('p.nama_produk', $nama_produk);
        }
        $this->db->where('dp.status = 3');

        $this->db->group_by('nama_produk');
        $this->db->order_by('nama_produk');

        $dataPesanan = $this->db->get()->result();

        echo json_encode($dataPesanan);
    }
}
