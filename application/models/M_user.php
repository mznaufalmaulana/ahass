<?php 

class M_user extends CI_Model {
    public function get_list_user($nama_pengguna, $role)
    {
        $this->db->select('id, fullname, username, role');
        $this->db->from('user');

        if (strlen($nama_pengguna) != 0) {
            $this->db->like('fullname', $nama_pengguna);
        }
        if (strlen($role) != 0) {
            $this->db->where('role', $role);
        }

        $dataPengguna = $this->db->get()->result();

        return $dataPengguna;
    }

    public function get_detail_user($id)
    {
        $this->db->select('id, fullname, username, role');
        $this->db->from('user');

        $this->db->where('id', $id);

        $dataPengguna = $this->db->get()->result();

        return $dataPengguna;
    }
}