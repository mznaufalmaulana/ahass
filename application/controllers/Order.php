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

    public function detail($id)
    {
        $data['judul'] = "Detail Order";

        $this->db->select('*');
        $this->db->from('data_kustomer');
        $this->db->where('nomor_order', $id);

        $data['dataKustomer'] = $this->db->get()->result();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('order/detail', $data);
        $this->load->view('templates/footer');
    }

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

        $dataKustomer = $this->db->get()->result();

        echo json_encode($dataKustomer);
    }

    public function getDataProduk()
    {
        $this->db->select('*');
        $this->db->from('produk');

        $dataProduk = $this->db->get()->result();

        echo json_encode($dataProduk);
    }

    public function setDataKustomer()
    {
        $data = [
            'nomor_order' => htmlspecialchars($this->input->post('id', true)),
            'nama' => htmlspecialchars($this->input->post('cust_name', true)),
            'telepon' => htmlspecialchars($this->input->post('telepon_no'), true),
            'nomor_polisi' => htmlspecialchars($this->input->post('plat_no'), true),
            'total_km' => htmlspecialchars($this->input->post('kilometer'), true),
            'tgl_servis' => htmlspecialchars($this->input->post('tgl_hari_ini'), true)
        ];

        $query = $this->db->insert('data_kustomer', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }
}
