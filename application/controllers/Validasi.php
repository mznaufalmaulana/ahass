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
        $this->load->model('M_validasi');

        if (!isset($_SESSION['id'])) {
            redirect('Auth/');
        }
    }

    public function index()
    {
        $data['judul'] = "Hasil Penjualan";

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

        $dataPenjualan = $this->M_validasi->get_list_laporan($tgl_mulai, $tgl_akhir);

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

        $dataPenjualan = $this->M_validasi->get_list_data_laporan($tanggal);

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

    // mengambil daftar pelanggan
    public function setValidasiDataLaporanManager()
    {
        $tanggal = $this->input->post('tanggal');

        $data = [
            "status" => '4'
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
