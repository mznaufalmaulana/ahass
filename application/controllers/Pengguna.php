<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
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
        $data['judul'] = "Pengguna";

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pengguna/index', $data);
        $this->load->view('templates/footer');
    }

    // mengambil daftar pengguna
    public function getListPengguna()
    {
        $nama_pengguna = $this->input->post('nama_pengguna');
        $role = $this->input->post('role');

        $this->db->select('id, fullname, username, role');
        $this->db->from('user');

        if (strlen($nama_pengguna) != 0) {
            $this->db->like('fullname', $nama_pengguna);
        }
        if (strlen($role) != 0) {
            $this->db->where('role', $role);
        }

        $dataPengguna = $this->db->get()->result();

        echo json_encode($dataPengguna);
    }

    // mengambil daftar pengguna
    public function getDetailPengguna()
    {
        $id = $this->input->post('id');

        $this->db->select('id, fullname, username, role');
        $this->db->from('user');

        $this->db->where('id', $id);

        $dataPengguna = $this->db->get()->result();

        echo json_encode($dataPengguna);
    }

    // cek username
    public function checkUsername()
    {
        $this->db->select('fullname, username, role');
        $this->db->where('username', $this->input->post('username'));
        $this->db->from('user');
        $query = $this->db->get()->result();
        if ($query) {
            $response_array['status'] = 'error';
        } else {
            $response_array['status'] = 'success';
        }

        echo json_encode($response_array);
    }

    // menyimpan data pengguna
    public function setDataPengguna()
    {
        $data = [
            "username" => $this->input->post('username'),
            "fullname" => $this->input->post('fullname'),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            "role" => $this->input->post('role')
        ];

        $query = $this->db->insert('user', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // menyimpan data pengguna
    public function setDataEditPengguna()
    {
        $data = [
            "username" => $this->input->post('username'),
            "fullname" => $this->input->post('fullname'),
            "role" => $this->input->post('role')
        ];

        $this->db->where('id', $this->input->post('id'));

        $query = $this->db->update('user', $data);
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }

    // menyimpan data pengguna
    public function deleteDataPengguna()
    {
        $this->db->where('id', $this->input->post('id'));
        $query = $this->db->delete('user');
        if ($query) {
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
        }

        echo json_encode($response_array);
    }
}
