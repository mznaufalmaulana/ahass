<?php 

class M_produk extends CI_Model {
    public function get_data_produk($nama_produk)
    {
        $this->db->select('*');
        $this->db->from('produk');

        if (strlen($nama_produk) != 0) {
            $this->db->like('nama_produk', $nama_produk);
        }

        $this->db->order_by('nama_produk');

        $dataProduk = $this->db->get()->result();

        return $dataProduk;
    }

    public function get_detail_produk($id)
    {
        $this->db->select('*');
        $this->db->from('produk');

        $this->db->where('id', $id);

        $dataProduk = $this->db->get()->result();

        return $dataProduk;
    }
}