<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('M_customer');
    }

    public function index()
    {
        $nomor = $this->input->post('order_no');
        $data['judul'] = "Detail Order";

        $user = $this->db->get_where('data_kustomer', ['nomor_order' => $nomor])->row_array();

        if ($user != null) {
            
            $query = $this->M_customer->get_data_customer($nomor);

            $session = [
                'id' => $user['nomor_order'],
                'username' => $user['nama'],
                'role' => 'customer'
            ];
            $this->session->set_userdata($session);

            $data['dataKustomer'] = $query;
            $this->load->view('customer/index', $data);
        } else {
            $this->load->view('errors/404_error');
        }
    }

    public function nota_pembayaran($nomor)
    {
        $data['judul'] = "Detail Order";

        $user = $this->db->get_where('data_kustomer', ['nomor_order' => $nomor])->row_array();

        if ($user != null) {

            $query = $this->M_customer->get_data_customer($nomor);

            $data = [
                "status" => 9,
            ];

            $this->db->where('nomor_order', $nomor);

            $update = $this->db->update('data_kustomer', $data);

            $data['dataKustomer'] = $query;
            $this->load->view('customer/nota_pembayaran', $data);
        } else {
            $this->load->view('errors/404_error');
        }
    }
}
