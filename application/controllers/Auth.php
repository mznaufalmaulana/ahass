<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => "Field Tidak Boleh Kosong"
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => "Field Tidak Boleh Kosong"
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/index');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user != null) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                    'role' => $user['role']
                ];
                $this->session->set_userdata($data);
                if ($user['role'] == 'admin') {
                    redirect('Order');
                } else if ($user['role'] == 'montir') {
                    redirect('Order');
                } else if ($user['role'] == 'kasir') {
                    redirect('Order');
                } else if ($user['role'] == 'manager') {
                    redirect('Laporan');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Maaf! Kata Sandi Salah </div>');
                redirect('/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Maaf! Pengguna Tidak Ditemukan </div>');
            redirect('/auth');
        }
    }

    public function customer()
    {
        $data['judul'] = "Customer";

        $this->load->view('auth/customer', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        redirect('/auth');
    }
}
