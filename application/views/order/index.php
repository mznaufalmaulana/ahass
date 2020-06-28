<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $judul ?></h1>
        </div>

        <div class="section-body">
            <div class="content-body fadeIn animated delay-1">
                <div class="search-group">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text first-group" style="font-weight: 900; color: #2262A2;"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" id="order-number" class="form-control" style="width:20%" placeholder="Cari Nomor Order">
                            <input placeholder="Pilih Tanggal" type="text" id="filter" class="form-control filter">
                            <?php if ($_SESSION['role'] == 'kasir') { ?>
                                <div class="btn float-right">
                                    <a href="#" class="btn btn-danger" onclick="tambahOrder()">
                                        Tambah Order
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div id="message"></div>
                    <div>
                        <div class="table-group">
                            <table class="table" id="list_customer" style="border-collapse: separate !important; font-size:16px !important; ">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th style="width: 25%">No Order</th>
                                        <th style="width: 15%">Tanggal Order</th>
                                        <th style="width: 35%">Nama Pelanggan</th>
                                        <th style="width: 35%">Status</th>
                                        <th style="width: 25%"></th>
                                    </tr>
                                </thead>
                                <tbody syle="font-weight: normal;" id="data_list_customer"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal tambah order -->
<div class="modal fade" id="modal-tambah-order" role="dialog" aria-hidden="true">
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
                                <input type="text" required="required" class="form-control form-modal" name="order_no" id="order_no" placeholder="Masukkan Nomor Order" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Nama Pelanggan</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="cust_name" id="cust_name" placeholder="Masukkan Nama Pelanggan">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Nomor Telepon</label>
                                <input maxlength="100" type="number" required="required" class="form-control form-modal" name="telepon_no" id="telepon_no" placeholder="Masukkan Telepon">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Nomor Polisi</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="plat_no" id="plat_no" placeholder="Masukkan Nomor Polisi, Mis: B 1234 XXX">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Rekap Kilometer</label>
                                <input type="number" min="0" required="required" class="form-control form-modal" name="kilometer" id="kilometer" placeholder="Masukkan Kilometer" oninput="validity.valid||(value='');">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Catatan untuk Montir</label>
                                <textarea class="form-control form-modal" name="catatan" id="catatan" style="resize: none"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Jenis Servis</label>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <select name="jenis" id="jenis_servis" class="form-control" style="width:100%;">
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

<script>
    var tgl_mulai_filter;
    var tgl_akhir_filter;
    var indexServis = 0;
    var dataPesanan = new Array;
    $(document).ready(function() {

        // Filtering Tanggal
        $('#filter').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Bersihkan',
                applyLabel: 'Terapkan'
            }
        });

        $('#filter').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD MMM YYYY') + ' - ' + picker.endDate.format('DD MMM YYYY'));

            var range = $('#filter').val();
            var date = range.split(" - ");

            var obj_tgl_mulai = new Date(Date.parse(date[0]));
            var obj_tgl_akhir = new Date(Date.parse(date[1]));
            console.log(obj_tgl_akhir);

            var month_custom = obj_tgl_mulai.getMonth() < 10 ? '0' + (obj_tgl_mulai.getMonth() + 1) : (obj_tgl_mulai.getMonth() + 1);
            tgl_mulai_filter = obj_tgl_mulai.getFullYear() + "-" + month_custom + "-" + obj_tgl_mulai.getDate();

            var month_end = obj_tgl_akhir.getMonth() < 10 ? '0' + (obj_tgl_akhir.getMonth() + 1) : (obj_tgl_akhir.getMonth() + 1);
            tgl_akhir_filter = obj_tgl_akhir.getFullYear() + "-" + month_end + "-" + obj_tgl_akhir.getDate();
            console.log(tgl_akhir_filter);
            show_data_customer();
        });

        $('#filter').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');

            tgl_mulai_filter = '';
            tgl_akhir_filter = '';
            show_data_customer();
        });

        // menampilkan data produk
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getDataProduk" ?>',
            success: function(data) {
                var jenis_servis = $('#jenis_servis');
                var dataJson = $.parseJSON(data);
                $.each(dataJson, function(key, value) {
                    jenis_servis.append('<option value="' + value.id + '">' + value.nama_produk + '</option>');
                });
            }
        });

        // membuat datatable order
        $('#list_customer').dataTable();
        $('#list_customer_filter').hide();
        $('#list_customer_length').hide();
        show_data_customer();
    });

    tinymce.init({
        selector: '#catatan',
        menubar: false
    });

    // cek harga jasa servis
    $('#jenis_servis').change(function() {
        idServis = $('#jenis_servis').val();
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getDataHarga/" ?>' + idServis,
            dataType: 'json',
            // data: data,
            success: function(data) {
                $('#harga-servis').val(data[0]['harga']);
            }
        });
    });

    // fitur pencarian nomor order
    $('#order-number').keyup(function() {
        show_data_customer();
    });

    // menampilkan data customer
    function show_data_customer() {
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Order/getListCustomer" ?>',
            data: {
                tgl_mulai: tgl_mulai_filter,
                tgl_akhir: tgl_akhir_filter,
                order_no: $('#order-number').val() == '' ? null : $('#order-number').val()
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $("#list_customer").dataTable().fnClearTable();
                for (i = 0; i < data.length; i++) {
                    var dataCust = [
                        data[i]['nomor_order'],
                        tanggalIndonesia(data[i]['tgl_servis']),
                        '<span class="text-capitalize">' + data[i]['nama'] + '</span>',
                        data[i]['status'] == 8 ? "Sedang Dikerjakan" : "Dalam Antrian",
                        '<a href="<?= BASE_URL . "Order/detail/" ?>' + data[i]['nomor_order'] + '" class="btn btn-danger" style="width: 100%;">Detail</a>'
                    ]
                    $("#list_customer").dataTable().fnAddData(dataCust);
                }
            }

        });
    }

    // melakukan tambah order
    $("#tambah-order").click(function(e) {
        e.preventDefault();

        var id = $('#order_no').val();
        var cust_name = $('#cust_name').val();
        var telepon_no = $('#telepon_no').val();
        var plat_no = $('#plat_no').val();
        var kilometer = $('#kilometer').val();
        var catatan = tinymce.get('catatan').getContent();

        var tanggal = new Date();
        var month_custom = tanggal.getMonth() < 10 ? '0' + (tanggal.getMonth() + 1) : (tanggal.getMonth() + 1);
        var tgl_hari_ini = tanggal.getFullYear() + "-" + month_custom + "-" + (tanggal.getDate());

        if (cust_name && telepon_no && plat_no && kilometer) {

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

            $.ajax({
                type: "POST",
                url: '<?= BASE_URL . "Order/setDataKustomer" ?>',
                data: {
                    id: id,
                    cust_name: cust_name,
                    telepon_no: telepon_no,
                    plat_no: plat_no,
                    kilometer: kilometer,
                    catatan: catatan,
                    tgl_hari_ini: tgl_hari_ini
                },
                success: function(data) {
                    for (var index = 0; index < dataPesanan.length; index++) {
                        if (dataPesanan[index]['id_produk'] == null) {
                            continue;
                        }
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
                                show_data_customer();
                            }
                        })
                    }
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
            $('#modal-tambah-order').animate({
                scrollTop: 0
            }, 'slow');
            $("#alertFadeOut").fadeOut(5000);
        }
    });

    function tambahOrder() {
        $("form[name='form-tambah-order']")
            .closest("form")
            .trigger("reset");
        $("#order_no").val(getOrderId())
        $("#modal-tambah-order").modal("show");
        for (var index = 0; index < dataPesanan.length; index++) {
            delete_servis(index);
        }
    }

    // generate Nomor Order
    function getOrderId() {
        var today = new Date();
        var order_no = 'ORD' + today.getFullYear() + (today.getMonth() + 1) + today.getDate() + today.getHours() + today.getMinutes() + today.getSeconds();
        return order_no;
    }

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
            if (dataPesanan.some(el => el.id_produk === jenisServis)) {
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

    //# sourceURL=/view/order/list_order.js
</script>