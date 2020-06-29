<?php 

class M_order extends CI_Model {
    public function get_data_customer($id)
    {
        $this->db->select('*');
        $this->db->from('data_kustomer');
        $this->db->where('nomor_order', $id);

        $data = $this->db->get()->result();

        return $data;
    }

    public function get_list_customer($order_no, $tgl_mulai, $tgl_akhir)
    {
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
        $this->db->or_where('status', 8);

        $dataKustomer = $this->db->get()->result();

        return $dataKustomer;
    }

    public function get_list_riwayat_customer($order_no, $tgl_mulai, $tgl_akhir)
    {
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
        $this->db->where('status != ', 0);

        $dataKustomer = $this->db->get()->result();

        return $dataKustomer;
    }

    public function get_data_produk()
    {
        $this->db->select('*');
        $this->db->from('produk');

        $this->db->order_by('nama_produk', 'asc');

        $dataProduk = $this->db->get()->result();

        return $dataProduk;
    }

    public function get_data_harga($id)
    {
        $this->db->select('harga');
        $this->db->from('produk');
        $this->db->where('id', $id);

        $dataHarga = $this->db->get()->result();

        return $dataHarga;
    }

    public function set_data_customer($id, $cust_name, $telepon, $plat_no, $kilometer, $catatan, $tgl_hari_ini)
    {
        $data = [
            'nomor_order' => $id,
            'nama' => $cust_name,
            'telepon' => $telepon,
            'nomor_polisi' => $plat_no,
            'total_km' => $kilometer,
            'catatan' => $catatan,
            'tgl_servis' => $tgl_hari_ini,
            'status' => 0,
        ];

        $query = $this->db->insert('data_kustomer', $data);
        if ($query) {
            $response_array = 'success';
        } else {
            $response_array = 'error';
        }

        return $response_array;
    }

    public function set_data_pesanan($nomor_order, $id_produk, $jumlah, $total_harga, $status, $tanggal_pembelian)
    {
        $data = [
            "nomor_order" => $nomor_order,
            "id_produk" => $id_produk,
            "jumlah" => $jumlah,
            "total_harga" => $total_harga,
            "status" => $status,
            'tanggal_pembelian' => $tanggal_pembelian
        ];

        $query = $this->db->insert('data_pesanan', $data);
        if ($query) {
            $response_array = 'success';
        } else {
            $response_array = 'error';
        }

        return $response_array;
    }

    public function set_proses($status, $nomor_order, $id_produk)
    {
        $data = [
            "status" => $status,
        ];

        $this->db->where('nomor_order', $nomor_order);
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->update('data_pesanan', $data);
        if ($query) {
            $response_array = 'success';
        } else {
            $response_array = 'error';
        }

        return $response_array;
    }

    public function set_proses_selesai($status, $nomor_order)
    {
        $data = [
            "status" => $status,
        ];

        $this->db->where('nomor_order', $nomor_order);
        $query = $this->db->update('data_kustomer', $data);
        if ($query) {
            $response_array = 'success';
        } else {
            $response_array = 'error';
        }

        return $response_array;
    }

    public function get_list_pesanan($nomor_order)
    {
        $this->db->select('dp.id, p.id as id_produk, p.nama_produk, p.harga, dp.jumlah, dp.nomor_order, dp.tanggal_pembelian, dp.total_harga, dp.status');
        $this->db->from('data_pesanan dp');
        $this->db->join('produk p', 'dp.id_produk = p.id');
        $this->db->where('nomor_order', $nomor_order);

        $this->db->order_by('nama_produk');

        $dataPesanan = $this->db->get()->result();

        return $dataPesanan;
    }

    public function delete_data_produk($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('data_pesanan');
        if ($query) {
            $response_array = 'success';
        } else {
            $response_array = 'error';
        }

        return $response_array;
    }

    public function get_data_pesanan_selesai($nomor_order)
    {
        $this->db->select('nomor_order,
	                        (SELECT COUNT(status) FROM data_pesanan WHERE nomor_order = "' . $nomor_order . '") AS total_pesanan,
                            (SELECT COUNT(status) FROM data_pesanan WHERE status = 2 AND nomor_order = "' . $nomor_order . '") AS total_selesai'
                        );
        $this->db->from('data_pesanan');
        $this->db->where('nomor_order', $nomor_order);
        $this->db->group_by('nomor_order');

        $dataPesanan = $this->db->get()->result();

        return $dataPesanan;
    }
}