<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><a href="<?= BASE_URL . 'Riwayat/' ?>" style="color: #34395e"><i class="material-icons align-middle" style="margin-right:4px; font-size:18px;">keyboard_backspace</i></a><?= $judul ?></h1>
        </div>

        <div class="section-body">
            <div class="content-body fadeIn animated delay-1">
                <div class="search-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nomor Order
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="outlet_detail"><?= $dataKustomer[0]->nomor_order ?></span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nama
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span class="text-capitalize" id="outlet_detail"><?= $dataKustomer[0]->nama ?></span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nomor Telepon
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail">+62 <?= $dataKustomer[0]->telepon ?></span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nomor Polisi
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span class="text-uppercase" id="username_detail"><?= $dataKustomer[0]->nomor_polisi ?></span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Kilometer
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail"><?= ribuan($dataKustomer[0]->total_km) ?> Km</span></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card-text" style="margin-bottom: 10px;">
                                <strong>Catatan</strong>
                                <div id="catatan">
                                    <?= $dataKustomer[0]->catatan ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                <div class="btn float-right" style="width: 100%; margin-bottom: 20px">
                                    <a href="<?= BASE_URL . 'riwayat' ?>" class="btn btn-danger btn-block" id="finish-button">
                                        Kembali
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div>
                        <div class="table-group">
                            <table class="table" id="list_pesanan" style="border-collapse: separate !important; font-size:16px !important; ">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 40%">Jenis Service</th>
                                        <th style="width: 20%">Harga Satuan</th>
                                        <th style="width: 15%">Kuantitas</th>
                                        <th style="width: 20%">Harga</th>
                                    </tr>
                                </thead>
                                <tbody syle="font-weight: normal;">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Total</th>
                                        <th><span id="totalHarga"></span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        // membuat datatable order
        $('#list_pesanan').dataTable();
        $('#list_pesanan_filter').hide();
        $('#list_pesanan_length').hide();

        $('#list_pesanan_montir').dataTable();
        $('#list_pesanan_montir_filter').hide();
        $('#list_pesanan_montir_length').hide();
        show_data_pesanan();
        $("p").addClass("mb-0");
    })

    function show_data_pesanan() {
        var progres;
        var txtProgres;
        var urutan = 1;
        var button;
        var total = 0;
        var role = '<?= $this->session->userdata["role"] ?>';

        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getListPesanan" ?>',
            data: {
                nomor_order: '<?= $dataKustomer[0]->nomor_order ?>'
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $("#list_pesanan").dataTable().fnClearTable();
                for (i = 0; i < data.length; i++) {
                    var dataCust = [
                        urutan++,
                        data[i]['nama_produk'],
                        formatRupiah(data[i]['harga'], "Rp"),
                        data[i]['jumlah'],
                        formatRupiah(data[i]['total_harga'], "Rp"),
                    ]
                    total += parseInt(data[i]['total_harga']);
                    $("#list_pesanan").dataTable().fnAddData(dataCust);
                }
                $("#totalHarga").text(formatRupiah(total.toString(), "Rp"))
            }
        });
    }

    function kerjakan(nomor_order, id_produk) {
        console.log(nomor_order, id_produk);
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/setProses" ?>',
            data: {
                nomor_order: nomor_order,
                id_produk: id_produk,
                status: 1
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                show_data_pesanan();
            }
        })
    }

    function selesai(nomor_order, id_produk) {
        console.log(nomor_order, id_produk);
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/setProses" ?>',
            data: {
                nomor_order: nomor_order,
                id_produk: id_produk,
                status: 2
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                show_data_pesanan();
            }
        })
    }

    $("#finish-button").on('click', function(e) {
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/setProsesSelesai" ?>',
            data: {
                nomor_order: '<?= $dataKustomer[0]->nomor_order ?>',
                status: 1
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                show_data_pesanan();
            }
        })
    })

    //# sourceURL=/view/order/detail_order.js
</script>