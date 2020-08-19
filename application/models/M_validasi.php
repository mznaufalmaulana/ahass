<?php

class M_validasi extends CI_Model
{
    public function get_list_laporan($tgl_mulai, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->from('data_pesanan');

        if (strlen($tgl_mulai) != 0) {
            $this->db->where('tanggal_pembelian >=', $tgl_mulai);
        }
        if (strlen($tgl_akhir) != 0) {
            $this->db->where('tanggal_pembelian <=', $tgl_akhir);
        }

        $this->db->order_by('tanggal_pembelian');
        $this->db->group_by('tanggal_pembelian');

        $dataPenjualan = $this->db->get()->result();


        return $dataPenjualan;
    }

    public function get_list_data_laporan($tanggal)
    {
        $this->db->select('
                        p.nama_produk AS nama_produk,
                        (SELECT SUM(jumlah) from data_pesanan dp where dp.tanggal_pembelian = "' . $tanggal . '" AND dp.id_produk = p.id) AS total,
                        (select ifnull(sum(dp.total_harga),0) from data_pesanan dp where dp.id_produk = p.id AND dp.status = 2 AND dp.tanggal_pembelian = "' . $tanggal . '" group by dp.id_produk) AS total_pemasukan
                        ');
        $this->db->from('data_pesanan dp');
        $this->db->join('produk p', 'dp.id_produk = p.id');
        $this->db->where('tanggal_pembelian', $tanggal);

        $this->db->where('dp.status = 2');
        $this->db->group_by('dp.id_produk');

        $dataPenjualan = $this->db->get()->result();

        return $dataPenjualan;
    }
}
