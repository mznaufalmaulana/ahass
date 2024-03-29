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
                                        <th style="width: 25%">Nama Pelanggan</th>
                                        <th style="width: 15%">Status Pembayaran</th>
                                        <th style="width: 20%"></th>
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

<script>
    var tgl_mulai_filter;
    var tgl_akhir_filter;
    var indexServis = 0;
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

        // membuat datatable order
        $('#list_customer').dataTable();
        $('#list_customer_filter').hide();
        $('#list_customer_length').hide();
        show_data_customer();
    });

    // fitur pencarian nomor order
    $('#order-number').keyup(function() {
        show_data_customer();
    });

    // menampilkan data customer
    function show_data_customer() {
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Riwayat/getListCustomer" ?>',
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
                        data[i]['status'] == 1 ? "Belum Bayar" : "Sudah Bayar",
                        '<a href="<?= BASE_URL . "Riwayat/detail/" ?>' + data[i]['nomor_order'] + '" class="btn btn-danger" style="width: 100%;">Detail</a>'
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