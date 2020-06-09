<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Validasi extends CI_Controller
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
        $data['judul'] = "Validasi Penjualan";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('validasi_penjualan/index', $data);
        $this->load->view('templates/footer');
    }

    // mengambil daftar pelanggan
    public function getListLaporan()
    {
        $tgl_mulai = $this->input->post('start_month');
        $tgl_akhir = $this->input->post('end_month');
        $this->db->select('*');
        $this->db->from('data_pesanan');

        if (strlen($tgl_mulai) != 0) {
            $this->db->where('tanggal_pembelian >=', $tgl_mulai);
        }
        if (strlen($tgl_akhir) != 0) {
            $this->db->where('tanggal_pembelian <=', $tgl_akhir);
        }

        $this->db->order_by('tanggal_pembelian');
        $this->db->group_by('tanggal_pembelian');

        $dataPenjualan = $this->db->get()->result();

        echo json_encode($dataPenjualan);
    }

    public function detail($tanggal)
    {
        $data['judul'] = "Detail Laporan";

        $data['tanggal'] = $tanggal;

        $this->db->select('*');
        $this->db->from('data_pesanan');
        $this->db->where('tanggal_pembelian', $tanggal);

        $data['status'] = $this->db->get()->first_row();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('validasi_penjualan/detail', $data);
        $this->load->view('templates/footer');
    }

    // mengambil daftar pelanggan
    public function getListDataLaporan()
    {
        $tanggal = $this->input->post('tanggal');

        $this->db->select('
                        p.nama_produk AS nama_produk,
                        (SELECT SUM(jumlah) from data_pesanan dp where dp.tanggal_pembelian = "' . $tanggal . '" AND dp.id_produk = p.id) AS total
                        ');
        $this->db->from('data_pesanan dp');
        $this->db->join('produk p', 'dp.id_produk = p.id');
        $this->db->where('tanggal_pembelian', $tanggal);

        $this->db->group_by('dp.id_produk');

        $dataPenjualan = $this->db->get()->result();

        echo json_encode($dataPenjualan);
    }

    // mengambil daftar pelanggan
    public function setValidasiDataLaporan()
    {
        $tanggal = $this->input->post('tanggal');

        $data = [
            "status" => '3'
        ];

        $this->db->where('tanggal_pembelian', $tanggal);
        $query = $this->db->update('data_pesanan', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }
}
