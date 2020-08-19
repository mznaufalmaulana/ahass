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
        $this->load->model('M_order');

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

        $data['dataKustomer'] = $this->M_order->get_data_customer($id);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('order/detail', $data);
        $this->load->view('templates/footer');
    }

    // mengambil daftar pelanggan
    public function getListCustomer()
    {
        $order_no = $this->input->post('order_no');
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $dataKustomer = $this->M_order->get_list_customer($order_no, $tgl_mulai, $tgl_akhir);

        echo json_encode($dataKustomer);
    }

    // mengambil data produk
    public function getDataProduk()
    {
        $dataProduk = $this->M_order->get_data_produk();

        echo json_encode($dataProduk);
    }

    // mengambil data harga produk
    public function getDataHarga($id)
    {
        $dataHarga = $this->M_order->get_data_harga($id);

        echo json_encode($dataHarga);
    }

    // menyimpan data pelanggan
    public function setDataKustomer()
    {
        $id = htmlspecialchars($this->input->post('id', true));
        $cust_name = htmlspecialchars($this->input->post('cust_name', true));
        $telepon = htmlspecialchars($this->input->post('telepon_no'), true);
        $plat_no = htmlspecialchars($this->input->post('plat_no'), true);
        $kilometer = htmlspecialchars($this->input->post('kilometer'), true);
        $catatan = $this->input->post('catatan');
        $tgl_hari_ini = htmlspecialchars($this->input->post('tgl_hari_ini'), true);
        $status = 0;

        $query = $this->M_order->set_data_customer($id, $cust_name, $telepon, $plat_no, $kilometer, $catatan, $tgl_hari_ini);
        if ($query == 'success') {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // menyimpan data pesanan
    public function setDataPesanan()
    {
        $nomor_order = $this->input->post('nomor_order');
        $id_produk = $this->input->post('id_produk');
        $jumlah = $this->input->post('jumlah');
        $total_harga = $this->input->post('total_harga');
        $status = $this->input->post('status');
        $tanggal_pembelian = $this->input->post('tgl_hari_ini');

        $query = $this->M_order->set_data_pesanan($nomor_order, $id_produk, $jumlah, $total_harga, $status, $tanggal_pembelian);
        if ($query == 'success') {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // update data pesanan
    public function setProses()
    {
        $status = $this->input->post('status');
        $nomor_order = $this->input->post('nomor_order');
        $id_produk = $this->input->post('id_produk');

        $query = $this->M_order->set_proses($status, $nomor_order, $id_produk);
        if ($query == 'success') {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // update data pesanan
    public function setProsesSelesai()
    {
        $status = $this->input->post('status');
        $nomor_order = $this->input->post('nomor_order');
        $nama_montir = $this->input->post('nama_montir');

        $query = $this->M_order->set_proses_selesai($status, $nomor_order, $nama_montir);
        if ($query == 'success') {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // mengambil data pesanan
    public function getListPesanan()
    {
        $nomor_order = $this->input->post('nomor_order');

        $dataPesanan = $this->M_order->get_list_pesanan($nomor_order);

        echo json_encode($dataPesanan);
    }

    // menyimpan data pengguna
    public function deleteDataProduk()
    {
        $id = $this->input->post('id');
        $query = $this->M_order->delete_data_produk($id);
        if ($query == 'success') {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    public function getDataPesananSelesai()
    {
        $nomor_order = $this->input->post('nomor_order');

        $dataPesanan = $this->M_order->get_data_pesanan_selesai($nomor_order);

        echo json_encode($dataPesanan);
    }

    public function getDataPekerjaan()
    {
        $nomor_order = $this->input->post('nomor_order');

        $this->db->select('status');
        $this->db->from('data_kustomer');
        $this->db->where('nomor_order', $nomor_order);

        $dataPesanan = $this->db->get()->result();

        echo json_encode($dataPesanan);
    }
}
