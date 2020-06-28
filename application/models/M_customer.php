<?php 

class M_customer extends CI_Model {
    public function get_data_customer($nomor)
    {
        $this->db->select('*');
        $this->db->from('data_kustomer');
        $this->db->where('nomor_order', $nomor);

        $query = $this->db->get()->result();

        return $query;
    }
}