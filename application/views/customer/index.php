<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="<?= BASE_THEME . '/img/logo1.jpg' ?>">
    <title>AHASS 669 | PT Astra Honda Motor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        body {
            background-color: #fff;
        }

        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }

        .main-content {
            padding: 30px;
        }

        #data-diri {
            padding: 30px;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="jumbotron">
            <div class="container text-center">
                <img src="<?= BASE_THEME . '/img/logo.svg' ?>" alt="logo" width="150">
            </div>
        </div>
        <div class="row" id="data-diri">
            <div class="col-lg-6">
                <div class="card-text" style="margin-bottom: 10px;">
                    Nomor Order
                    <div class="float-right" style="font-weight: bold; display: inline-block; float: right;"><span id="outlet_detail"><?= $dataKustomer[0]->nomor_order ?></span></div>
                </div>
                <div class="card-text" style="margin-bottom: 10px;">
                    Nama
                    <div class="float-right" style="font-weight: bold; display: inline-block; float: right;"><span class="text-capitalize" id="outlet_detail"><?= $dataKustomer[0]->nama ?></span></div>
                </div>
                <div class="card-text" style="margin-bottom: 10px;">
                    Nomor Telepon
                    <div class="float-right" style="font-weight: bold; display: inline-block; float: right;"><span id="username_detail">+62 <?= $dataKustomer[0]->telepon ?></span></div>
                </div>
                <div class="card-text" style="margin-bottom: 10px;">
                    Nomor Polisi
                    <div class="float-right" style="font-weight: bold; display: inline-block; float: right;"><span class="text-uppercase" id="username_detail"><?= $dataKustomer[0]->nomor_polisi ?></span></div>
                </div>
                <div class="card-text" style="margin-bottom: 10px;">
                    Kilometer
                    <div class="float-right" style="font-weight: bold; display: inline-block; float: right;"><span id="username_detail"><?= ribuan($dataKustomer[0]->total_km) ?> Km</span></div>
                </div>
                <div class="card-text" style="margin-bottom: 10px;">
                    Nama Montir
                    <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail"><?= $dataKustomer[0]->nama_montir ?> </span></div>
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

        <div>
            <div class="table-group">
                <table class="table" id="list_pesanan" style="border-collapse: separate !important; font-size:16px !important; ">
                    <thead syle="font-weight: normal;">
                        <tr>
                            <th class="text-center" style="width: 5%">No</th>
                            <th style="width: 25%">Jenis Service</th>
                            <th>Status</th>
                            <th style="width: 10%">Jumlah</th>
                            <th style="width: 10%">Total harga</th>
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

        <center>
            <a href="<?= BASE_URL . 'Auth/logout' ?>" class="btn btn-danger" style="width: 30%">
                <i class="fas fa-sign-out-alt"></i> Kembali
            </a>
        </center>
    </div>
    <footer class="container-fluid text-center">
        Copyright &copy; 2020 <div class="bullet"></div> Honda Putra Jaya Malang
    </footer>
</body>

<script>
    $(document).ready(function() {
        // membuat datatable order
        $('#list_pesanan').dataTable();
        $('#list_pesanan_filter').hide();
        $('#list_pesanan_length').hide();

        show_data_pesanan();
        $("p").addClass("mb-0");
    })

    function show_data_pesanan() {
        var progres;
        var txtProgres;
        var urutan = 1;
        var total = 0;
        var button;

        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getListPesanan" ?>',
            data: {
                nomor_order: '<?= $dataKustomer[0]->nomor_order ?>'
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $("#list_pesanan").dataTable().fnClearTable();
                for (i = 0; i < data.length; i++) {
                    if (data[i]['status'] == 0) {
                        txtProgres = '<a href="#" class="btn btn-danger btn-block" style=" cursor: context-menu;">Dalam Antrian</a>';
                    } else if (data[i]['status'] == 1) {
                        txtProgres = '<a href="#" class="btn btn-warning btn-block" style=" cursor: context-menu;">Sedang Dikerjakan</a>';
                    } else if (data[i]['status'] == 2) {
                        txtProgres = '<a href="#" class="btn btn-success btn-block" style=" cursor: context-menu;">Selesai</a>';
                    }

                    var dataCust = [
                        urutan++,
                        data[i]['nama_produk'],
                        txtProgres,
                        data[i]['jumlah'],
                        formatRupiah(data[i]['total_harga'], 'Rp'),
                    ]
                    total += parseInt(data[i]['total_harga']);
                    $("#list_pesanan").dataTable().fnAddData(dataCust);
                }
                $("#totalHarga").text(formatRupiah(total.toString(), "Rp"));
            }
        });
    }

    // Format Rupiah
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    //# sourceURL=/view/order/detail_order.js
</script>

<!-- datatables -->
<script src="<?= BASE_THEME . '/modules/datatables/datatables.min.js' ?>"></script>

</html>