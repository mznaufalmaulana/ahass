<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
        $data['judul'] = "Produk";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    // mengambil daftar pengguna
    public function getListProduk()
    {
        $nama_produk = $this->input->post('nama_produk');

        $this->db->select('*');
        $this->db->from('produk');

        if (strlen($nama_produk) != 0) {
            $this->db->like('nama_produk', $nama_produk);
        }

        $this->db->order_by('nama_produk');

        $dataProduk = $this->db->get()->result();

        echo json_encode($dataProduk);
    }

    // menyimpan data pengguna
    public function setDataProduk()
    {
        $data = [
            "id" => $this->input->post('id'),
            "nama_produk" => $this->input->post('nama_produk'),
            "harga" => $this->input->post('harga')
        ];

        $query = $this->db->insert('produk', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // mengambil daftar pengguna
    public function getDetailProduk()
    {
        $id = $this->input->post('id');

        $this->db->select('*');
        $this->db->from('produk');

        $this->db->where('id', $id);

        $dataPengguna = $this->db->get()->result();

        echo json_encode($dataPengguna);
    }

    // menyimpan data pengguna
    public function setDataEditProduk()
    {
        $data = [
            "nama_produk" => $this->input->post('nama_produk'),
            "harga" => $this->input->post('harga')
        ];

        $this->db->where('id', $this->input->post('id'));

        $query = $this->db->update('produk', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // menyimpan data pengguna
    public function deleteDataProduk()
    {
        $this->db->where('id', $this->input->post('id'));
        $query = $this->db->delete('produk');
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }
}
