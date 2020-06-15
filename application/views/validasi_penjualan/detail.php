<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $judul ?></h1>
        </div>

        <div class="section-body">
            <div class="content-body fadeIn animated delay-1">
                <div class="search-group">
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                            <div class="card-text" style="margin-bottom: 10px;">
                                Tanggal Laporan
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="outlet_detail"><?= TanggalIndonesia($tanggal) ?></span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Status Validasi
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;">
                                    <span>
                                        <?php if ($status->status == 3 && $_SESSION['role'] == 'kasir') { ?>
                                            Sudah Divalidasi
                                        <?php } else if ($status->status == 4 && $_SESSION['role'] == 'manager') {?>
                                            Sudah Divalidasi
                                        <?php } else {?>
                                            Belum Divalidasi
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="message"></div>
                    <div>
                        <div class="table-group">
                            <table class="table" id="list_laporan" style="border-collapse: separate !important; font-size:16px !important; ">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th style="width: 75%">Nama Produk</th>
                                        <th style="width: 25%">Total Pembelian</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <div class="btn float-right" style="width: 100%; margin-bottom: 20px">
                                <?php if ($status->status != 3 && $_SESSION['role'] == 'kasir') { ?>
                                    <a href="#" class="btn btn-danger btn-block" id="add-order">
                                        Validasi Laporan
                                    </a>
                                <?php } else if ($status->status != 4 && $_SESSION['role'] == 'manager') { ?>
                                    <a href="#" class="btn btn-danger btn-block" id="add-order">
                                        Validasi Laporan
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= BASE_URL . 'Validasi' ?>" class="btn btn-danger btn-block">
                                        Kembali
                                    </a>
                                <?php } ?>
                            </div>
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
        $('#list_laporan').dataTable();
        $('#list_laporan_filter').hide();
        $('#list_laporan_length').hide();
        show_data_laporan();

    })

    // menampilkan data laporan penjualan
    function show_data_laporan() {
        var nomor = 1;
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Validasi/getListDataLaporan" ?>',
            data: {
                tanggal: '<?= $tanggal ?>'
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $("#list_laporan").dataTable().fnClearTable();
                for (i = 0; i < data.length; i++) {
                    var dataCust = [
                        data[i]['nama_produk'],
                        data[i]['total']
                    ]
                    $("#list_laporan").dataTable().fnAddData(dataCust);
                }
            }

        });
    }

    $("#add-order").on('click', function(e) {
        if ('<?= $this->session->userdata["role"] ?>' == 'kasir') {
            var url = "Validasi/setValidasiDataLaporan";
        } else {
            var url = "Validasi/setValidasiDataLaporanManager";
        }
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL ?>' + url,
            data: {
                tanggal: '<?= $tanggal ?>'
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data['status'] == 'success') {
                    $('#message').html(
                        '<div id="alertFadeOut" class="alert alert-primary alert-dismissible show fadeIn animated" style="width:100% !important; margin-bottom:20px !important;">' +
                        '<div class="alert-body">' +
                        '<button class="close" data-dismiss="alert">' +
                        '<span>&times;</span>' +
                        '</button>' +
                        '<b>Berhasil!</b> Data Laporan Valid' +
                        '</div>' +
                        '</div>');
                    $("#alertFadeOut").fadeOut(5000);
                    show_data_laporan();
                    window.location.href = "<?= BASE_URL . 'Validasi' ?>";
                } else if (data['status'] == 'error') {
                    $('#message').html(
                        '<div id="alertFadeOut" class="alert alert-danger alert-dismissible show fadeIn animated" style="width:100% !important; margin-bottom:20px !important;">' +
                        '<div class="alert-body">' +
                        '<button class="close" data-dismiss="alert">' +
                        '<span>&times;</span>' +
                        '</button>' +
                        '<b>Error!</b>' +
                        '</div>' +
                        '</div>');
                    $("#alertFadeOut").fadeOut(5000);
                    show_data_laporan();
                }
            }
        });
    })

    //# sourceURL=/view/ahass/laporan.js
</script>