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
        $this->db->where('status', 0);

        $dataKustomer = $this->db->get()->result();

        echo json_encode($dataKustomer);
    }

    // mengambil data produk
    public function getDataProduk()
    {
        $this->db->select('*');
        $this->db->from('produk');

        $this->db->order_by('nama_produk', 'asc');

        $dataProduk = $this->db->get()->result();

        echo json_encode($dataProduk);
    }

    // mengambil data harga produk
    public function getDataHarga($id)
    {
        $this->db->select('harga');
        $this->db->from('produk');
        $this->db->where('id', $id);

        $dataHarga = $this->db->get()->result();

        echo json_encode($dataHarga);
    }

    // menyimpan data pelanggan
    public function setDataKustomer()
    {
        $data = [
            'nomor_order' => htmlspecialchars($this->input->post('id', true)),
            'nama' => htmlspecialchars($this->input->post('cust_name', true)),
            'telepon' => htmlspecialchars($this->input->post('telepon_no'), true),
            'nomor_polisi' => htmlspecialchars($this->input->post('plat_no'), true),
            'total_km' => htmlspecialchars($this->input->post('kilometer'), true),
            'catatan' => $this->input->post('catatan'),
            'tgl_servis' => htmlspecialchars($this->input->post('tgl_hari_ini'), true),
            'status' => 0,
        ];

        $query = $this->db->insert('data_kustomer', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // menyimpan data pesanan
    public function setDataPesanan()
    {
        $data = [
            "nomor_order" => $this->input->post('nomor_order'),
            "id_produk" => $this->input->post('id_produk'),
            "jumlah" => $this->input->post('jumlah'),
            "total_harga" => $this->input->post('total_harga'),
            "status" => $this->input->post('status'),
            'tanggal_pembelian' => $this->input->post('tgl_hari_ini')
        ];

        $query = $this->db->insert('data_pesanan', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // update data pesanan
    public function setProses()
    {
        $data = [
            "status" => $this->input->post('status'),
        ];

        $this->db->where('nomor_order', $this->input->post('nomor_order'));
        $this->db->where('id_produk', $this->input->post('id_produk'));
        $query = $this->db->update('data_pesanan', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // update data pesanan
    public function setProsesSelesai()
    {
        $data = [
            "status" => $this->input->post('status'),
        ];

        $this->db->where('nomor_order', $this->input->post('nomor_order'));
        $query = $this->db->update('data_kustomer', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // mengambil data pesanan
    public function getListPesanan()
    {
        $this->db->select('dp.id, p.id as id_produk, p.nama_produk, p.harga, dp.jumlah, dp.nomor_order, dp.tanggal_pembelian, dp.total_harga, dp.status');
        $this->db->from('data_pesanan dp');
        $this->db->join('produk p', 'dp.id_produk = p.id');
        $this->db->where('nomor_order', $this->input->post('nomor_order'));

        $this->db->order_by('nama_produk');

        $dataPesanan = $this->db->get()->result();

        echo json_encode($dataPesanan);
    }

    // menyimpan data pengguna
    public function deleteDataProduk()
    {
        $this->db->where('id', $this->input->post('id'));
        $query = $this->db->delete('data_pesanan');
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }
}
