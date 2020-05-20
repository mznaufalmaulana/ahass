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

    // mengambil daftar pelanggan
    public function getListCustomer()
    {
        $order_no = $this->input->post('order_no');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $this->db->select('*');
        $this->db->from('data_kustomer');

        if (strlen($order_no) != 0) {
            $this->db->like('nomor_order', $order_no);
        }
        if (strlen($tgl_mulai) != 0) {
            $this->db->where('tgl_servis >=', $tgl_mulai);
        }
        if (strlen($tgl_akhir) != 0) {
            $this->db->where('tgl_servis <=', $tgl_akhir);
        }
        $this->db->where('status', 1);

        $dataKustomer = $this->db->get()->result();

        echo json_encode($dataKustomer);
    }

    public function detail($id)
    {
        $data['judul'] = "Detail Order";

        $this->db->select('*');
        $this->db->from('data_kustomer');
        $this->db->where('nomor_order', $id);

        $data['dataKustomer'] = $this->db->get()->result();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('riwayat/detail', $data);
        $this->load->view('templates/footer');
    }
}
