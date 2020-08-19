<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><a href="<?= BASE_URL . 'Order/' ?>" style="color: #34395e"><i class="material-icons align-middle" style="margin-right:4px; font-size:18px;">keyboard_backspace</i></a><?= $judul ?></h1>
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
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <div class="btn float-right" style="width: 100%; margin-bottom: 20px;">
                                <?php if ($_SESSION['role'] == 'montir') { ?>
                                    <a href="#" class="btn btn-danger btn-block" id="finish-button">
                                        Selesai
                                    </a>
                                    <a href="#" class="btn btn-danger btn-block" id="kerjakan-button">
                                        Kerjakan
                                    </a>
                                <?php } else if ($_SESSION['role'] == 'kasir') { ?>
                                    <a href="#" class="btn btn-danger btn-block" id="add-order">
                                        Tambah Order
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div id="message"></div>
                    <div>
                        <div class="table-group">
                            <?php if ($_SESSION['role'] == 'kasir' || $_SESSION['role'] == 'admin') { ?>
                                <table class="table" id="list_pesanan" style="border-collapse: separate !important; font-size:16px !important; ">
                                <?php } else { ?>
                                    <table class="table" id="list_pesanan_montir" style="border-collapse: separate !important; font-size:16px !important; ">
                                    <?php } ?>
                                    <thead syle="font-weight: normal;">
                                        <tr>
                                            <th class="text-center" style="width: 5%">No</th>
                                            <th style="width: 15%">Jenis Service</th>
                                            <th>Status</th>
                                            <?php if ($_SESSION['role'] == 'montir') { ?>
                                                <th style="width: 20%"></th>
                                            <?php } else { ?>
                                                <th style="width: 10%"></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody syle="font-weight: normal;">
                                    </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal tambah order -->
<div class="modal fade" id="modal-tambah-order" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="message-error"></div>
                        <form style="margin-bottom:30px;" enctype="multipart/form-data" action="" name="form-tambah-order">
                            <div class="form-group">
                                <label class="control-label label-form">Nomor Order</label>
                                <input type="text" required="required" class="form-control form-modal" name="order_no" id="order_no" placeholder="Masukkan Nomor Order" value="<?= $dataKustomer[0]->nomor_order ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Jenis Servis</label>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <select name="jenis_servis" id="jenis_servis" class="form-control form-modal">
                                            <option value="" selected disabled>Pilih Jenis / Sparepart</option>
                                        </select>
                                        <input type="text" id="harga-servis" hidden>
                                        <div id="data-ada"></div>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" required="required" class="form-control form-modal" name="jumlah" id="jumlah" placeholder="Jumlah" min="0">
                                    </div>
                                    <div class="col-lg-1">
                                        <a href="#" id="tambah-pesanan" class="btn btn-danger"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-11" id="data-pesanan">
                                    </div>
                                    <div class="col-lg-1" id="hapus-data-pesanan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <a href="#" class="btn btn-danger" id="tambah-order" style="width: 140px;">SIMPAN</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End modal tambah order -->

<!-- Modal tambah order -->
<div class="modal fade" id="modal-hapus-order" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="message-error"></div>
                        <form style="margin-bottom:30px;" enctype="multipart/form-data" action="" name="form-hapus-order">
                            <input maxlength="100" type="text" required="required" class="form-control form-modal" name="id_hapus" id="id_hapus" placeholder="Masukkan Nama Pengguna" hidden>
                            <div class="form-group">
                                <h3>Apakah Anda Yakin?</h3>
                            </div>
                            <div class="form-group float-right">
                                <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" style="width: 140px;">TIDAK</a>
                                <a href="#" class="btn btn-danger" id="hapus-penguna" style="width: 140px;">YA</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End modal tambah order -->

<script>
    var indexServis = 0;
    var dataPesanan = new Array;
    var dataPesananAwal = new Array;
    $(document).ready(function() {
        // menampilkan data produk
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getDataProduk" ?>',
            // data: data,
            success: function(data) {
                var jenis_servis = $('#jenis_servis');
                var dataJson = $.parseJSON(data);
                $.each(dataJson, function(key, value) {
                    jenis_servis.append('<option value="' + value.id + '">' + value.nama_produk + '</option>');
                });
            }
        });

        // membuat datatable order
        $('#list_pesanan').dataTable();
        $('#list_pesanan_filter').hide();
        $('#list_pesanan_length').hide();

        $('#list_pesanan_montir').dataTable();
        $('#list_pesanan_montir_filter').hide();
        $('#list_pesanan_montir_length').hide();
        show_data_pesanan();
        $("p").addClass("mb-0");
        cekDataPesananSelesai();
    })

    function show_data_pesanan() {
        var progres;
        var txtProgres;
        var urutan = 1;
        var button;
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
                if (role == 'montir') {
                    var html = '';
                    $("#list_pesanan_montir").dataTable().fnClearTable();
                    for (i = 0; i < data.length; i++) {
                        var id_produk = "'" + data[i]['id_produk'] + "'";
                        var id_pesanan = "'" + data[i]['nomor_order'] + "'";
                        if (data[i]['status'] == 0) {
                            txtProgres = '<a href="#" class="btn btn-danger btn-block" style=" cursor: context-menu;">Dalam Antrian</a>';
                            button = '<a href="#" class="btn btn-warning" onclick="kerjakan(' + id_pesanan + ',' + id_produk + ')" style="width: 80px">Kerjakan</a>' + '&nbsp;' +
                                '<a href="#" class="btn btn-success" onclick="selesai(' + id_pesanan + ',' + id_produk + ')" style="width: 80px">Selesai</a>';
                        } else if (data[i]['status'] == 1) {
                            txtProgres = '<a href="#" class="btn btn-warning btn-block" style=" cursor: context-menu;">Sedang Dikerjakan</a>';
                            button = '<a href="#" class="btn btn-success" onclick="selesai(' + id_pesanan + ',' + id_produk + ')" style="width: 80px">Selesai</a>';
                        } else if (data[i]['status'] == 2) {
                            txtProgres = '<a href="#" class="btn btn-success btn-block" style=" cursor: context-menu;">Selesai</a>';
                            button = '';
                        }

                        var dataCust = [
                            urutan++,
                            data[i]['nama_produk'],
                            txtProgres,
                            button
                        ]
                        $("#list_pesanan_montir").dataTable().fnAddData(dataCust);

                        var value = {
                            "id_produk": data[i]['id_produk'],
                            "jumlah": data[i]['jumlah'],
                            "total_harga": data[i]['total_harga'],
                            "status": 0
                        }
                        dataPesananAwal.push(value);
                    }
                } else {
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
                            '<a href="#" onclick="hapusProduk(\'' + data[i]['id'] + '\')" class="btn btn-danger">Hapus</a>'
                        ]
                        $("#list_pesanan").dataTable().fnAddData(dataCust);

                        var value = {
                            "id_produk": data[i]['id_produk'],
                            "jumlah": data[i]['jumlah'],
                            "total_harga": data[i]['total_harga'],
                            "status": 0
                        }
                        dataPesananAwal.push(value);
                    }
                }
                cekDataPesananSelesai();
                cekDikerjakan();
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
                window.location.href = "<?= BASE_URL . 'order' ?>";
            }
        })
    })

    $("#kerjakan-button").on('click', function(e) {
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/setProsesSelesai" ?>',
            data: {
                nomor_order: '<?= $dataKustomer[0]->nomor_order ?>',
                nama_montir: '<?= $this->session->userdata('fullname') ?>',
                status: 8
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                $("#kerjakan-button").hide();
            }
        })
    })

    function hapusProduk(id) {
        $("form[name='form-hapus-order']")
            .closest("form")
            .trigger("reset");
        $("#id_hapus").val(id);
        $("#modal-hapus-order").modal("show");
    }

    $("#add-order").on('click', function(e) {
        $("form[name='form-tambah-order']")
            .closest("form")
            .trigger("reset");
        $("#modal-tambah-order").modal("show");
    })

    // cek harga jasa servis
    $('#jenis_servis').change(function() {
        idServis = $('#jenis_servis').val();
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getDataHarga/" ?>' + idServis,
            dataType: 'json',
            // data: data,
            success: function(data) {
                console.log(data);

                $('#harga-servis').val(data[0]['harga']);
            }
        });
    });

    // menambahkan data pesanan
    $('#tambah-pesanan').on('click', function(e) {
        var jenisServis = $('#jenis_servis').val();

        var txtServis = $("#jenis_servis option:selected").text();
        var jumlah = $("#jumlah").val();

        var totalHarga = jumlah * $("#harga-servis").val();

        var value = {
            "id_produk": jenisServis,
            "jumlah": jumlah,
            "total_harga": totalHarga,
            "status": 0
        }

        if (jenisServis != '' && jenisServis != null && jumlah != '') {
            if (dataPesanan.some(el => el.id_produk === jenisServis) || dataPesananAwal.some(el => el.id_produk === jenisServis)) {
                $('#data-ada').append('<span class="text-danger alertFadeOutService">Data telah dimasukkan</span>');
                $(".alertFadeOutService").fadeOut(3000);
            } else {
                dataPesanan.push(value);
                $('#jenis_servis').val('');
                $("#jumlah").val('');
                $('#data-pesanan').append(
                    '<input type="text" id="servis' + indexServis + '" class="form-control form-modal" value="' +
                    txtServis + ' - ' +
                    jumlah +
                    '" style="margin-bottom: 5px;" disabled>');

                $('#hapus-data-pesanan').append(
                    '<a href="#" class="btn text-danger" id="delete_servis' + indexServis + '" onclick="delete_servis(' + indexServis + ')" style="margin-bottom: 5px;">' +
                    '<i class="fas fa-times"></i>' +
                    '</a>');
                indexServis++;
            }
        } else {
            $('#data-ada').append('<span class="text-danger alertFadeOutService">Data Belum Lengkap</span>');
            $(".alertFadeOutService").fadeOut(5000);
        }
    })

    // menghapus data pesanan
    function delete_servis(index) {
        var value = {
            "id_produk": null,
            "jumlah": null,
            "status": null
        }
        dataPesanan[index] = value;
        $('#servis' + index).remove();
        $('#delete_servis' + index).remove();
    }

    // melakukan tambah order
    $("#tambah-order").click(function(e) {
        var tanggal = new Date();
        var month_custom = tanggal.getMonth() < 10 ? '0' + (tanggal.getMonth() + 1) : (tanggal.getMonth() + 1);
        var tgl_hari_ini = tanggal.getFullYear() + "-" + month_custom + "-" + (tanggal.getDate());

        var data_kosong = 0;
        for (var index = 0; index < dataPesanan.length; index++) {
            if (dataPesanan[index]['id_produk'] == null) {
                data_kosong++;
                continue;
            }
        }
        if (data_kosong == dataPesanan.length || dataPesanan.length == 0) {
            $('#message-error').html(
                '<div id="alertFadeOut" class="alert alert-danger alert-dismissible show fadeIn animated" style="width:100% !important; margin-bottom:20px !important;">' +
                '<div class="alert-body">' +
                '<button class="close" data-dismiss="alert">' +
                '<span>&times;</span>' +
                '</button>' +
                'Mohon lengkapi data Pesanan Anda' +
                '</div>' +
                '</div>');
            $('#modal-tambah-order').animate({
                scrollTop: 0
            }, 'slow');
            $("#alertFadeOut").fadeOut(5000);
            return true;
        }
        for (var index = 0; index < dataPesanan.length; index++) {
            if (dataPesanan[index]['id_produk'] == null) {
                continue;
            }
            var id = $("#order_no").val();
            var id_produk = dataPesanan[index]['id_produk'];
            var jumlah = dataPesanan[index]['jumlah'];
            var total_harga = dataPesanan[index]['total_harga'];
            var status = dataPesanan[index]['status'];
            $.ajax({
                type: "POST",
                url: '<?= BASE_URL . "Order/setDataPesanan" ?>',
                data: {
                    "nomor_order": id,
                    "id_produk": id_produk,
                    "jumlah": jumlah,
                    "total_harga": total_harga,
                    "status": status,
                    "tgl_hari_ini": tgl_hari_ini
                },
                success: function(data) {
                    $('#message').html(
                        '<div id="alertFadeOut" class="alert alert-primary alert-dismissible show fadeIn animated" style="width:100% !important; margin-bottom:20px !important;">' +
                        '<div class="alert-body">' +
                        '<button class="close" data-dismiss="alert">' +
                        '<span>&times;</span>' +
                        '</button>' +
                        'Data Berhasil Disimpan' +
                        '</div>' +
                        '</div>');
                    $("#alertFadeOut").fadeOut(5000);
                    $("#modal-tambah-order").modal("hide");
                    $("form[name='form-tambah-order']")
                        .closest("form")
                        .trigger("reset");
                    show_data_pesanan();
                }
            })
        }
    })

    // melakukan tambah penguna
    $("#hapus-penguna").click(function(e) {
        e.preventDefault();

        var id = $('#id_hapus').val();

        if (id) {

            $.ajax({
                type: "POST",
                url: '<?= BASE_URL . "Order/deleteDataProduk" ?>',
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#message').html(
                        '<div id="alertFadeOut" class="alert alert-primary alert-dismissible show fadeIn animated" style="width:100% !important; margin-bottom:20px !important;">' +
                        '<div class="alert-body">' +
                        '<button class="close" data-dismiss="alert">' +
                        '<span>&times;</span>' +
                        '</button>' +
                        'Data Berhasil Disimpan' +
                        '</div>' +
                        '</div>');
                    $("#alertFadeOut").fadeOut(5000);
                    $("#modal-hapus-order").modal("hide");
                    $("form[name='form-hapus-order']")
                        .closest("form")
                        .trigger("reset");
                    show_data_pesanan();
                }
            });
        } else {
            $('#message-error').html(
                '<div id="alertFadeOut" class="alert alert-danger alert-dismissible show fadeIn animated" style="width:100% !important; margin-bottom:20px !important;">' +
                '<div class="alert-body">' +
                '<button class="close" data-dismiss="alert">' +
                '<span>&times;</span>' +
                '</button>' +
                'Mohon lengkapi data Anda' +
                '</div>' +
                '</div>');
            $('#modal-hapus-order').animate({
                scrollTop: 0
            }, 'slow');
            $("#alertFadeOut").fadeOut(5000);
        }
    });

    function cekDataPesananSelesai() {
        var nomor_order = '<?= $dataKustomer[0]->nomor_order ?>';
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getDataPesananSelesai" ?>',
            data: {
                nomor_order: nomor_order
            },
            dataType: 'json',
            success: function(data) {
                if (data[0]['total_pesanan'] == data[0]['total_selesai']) {
                    var value = '';
                    $("#finish-button").show();
                } else {
                    var value = '';
                    $("#finish-button").hide();
                }
            }
        })
    }

    function cekDikerjakan() {
        var nomor_order = '<?= $dataKustomer[0]->nomor_order ?>';
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getDataPekerjaan" ?>',
            data: {
                nomor_order: nomor_order
            },
            dataType: 'json',
            success: function(data) {
                if (data[0]['status'] == 8) {
                    $("#kerjakan-button").hide();
                } else {
                    $("#kerjakan-button").show();
                }
            }
        })
    }

    //# sourceURL=/view/order/detail_order.js
</script>