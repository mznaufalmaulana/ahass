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
                            <div class="btn float-right">
                                <a href="#" class="btn btn-danger" onclick="tambahOrder()">
                                    Tambah Order
                                </a>
                            </div>
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
                                <label class="control-label label-form">Jenis Servis</label>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <select name="jenis_servis" id="jenis_servis" class="form-control form-modal">
                                            <option value="" selected disabled>Pilih Jenis / Sparepart</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" required="required" class="form-control form-modal" name="jumlah" id="jumlah" placeholder="Jumlah" min="0">
                                    </div>
                                    <div class="col-lg-1">
                                        <a href="#" id="tambah-pesanan" class="btn btn-danger"><i class="fas fa-plus"></i></a>
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
    $(document).ready(function() {
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

        $('#list_customer').dataTable();
        $('#list_customer_filter').hide();
        $('#list_customer_length').hide();
        show_data_customer();
    });

    $('#order-number').keyup(function() {
        show_data_customer();
    });

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
                        data[i]['nama'],
                        '<a href="<?= BASE_URL . "Order/detail/" ?>' + data[i]['nomor_order'] + '" class="btn btn-danger" style="width: 100%;">Detail</a>'
                    ]
                    $("#list_customer").dataTable().fnAddData(dataCust);
                }
            }

        });
    }

    $("#tambah-order").click(function(e) {
        e.preventDefault();

        var id = $('#order_no').val();
        var cust_name = $('#cust_name').val();
        var telepon_no = $('#telepon_no').val();
        var plat_no = $('#plat_no').val();
        var kilometer = $('#kilometer').val();

        var tanggal = new Date();
        var month_custom = tanggal.getMonth() < 10 ? '0' + (tanggal.getMonth() + 1) : (tanggal.getMonth() + 1);
        var tgl_hari_ini = tanggal.getFullYear() + "-" + month_custom + "-" + (tanggal.getDate());

        $.ajax({
            type: "POST",
            url: '<?= BASE_URL . "Order/setDataKustomer" ?>',
            data: {
                id: id,
                cust_name: cust_name,
                telepon_no: telepon_no,
                plat_no: plat_no,
                kilometer: kilometer,
                tgl_hari_ini: tgl_hari_ini
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
                $("#alertFadeOut").fadeOut(3000);
                $("#modal-tambah-order").modal("hide");
                $("form[name='form-tambah-order']")
                    .closest("form")
                    .trigger("reset");
            }
        });
    });

    function tambahOrder() {
        $("form[name='form-tambah-order']")
            .closest("form")
            .trigger("reset");
        $("#order_no").val(getOrderId())
        $("#modal-tambah-order").modal("show");
    }

    function getOrderId() {
        var today = new Date();
        var order_no = 'ORD' + today.getFullYear() + (today.getMonth() + 1) + today.getDate() + today.getHours() + today.getMinutes() + today.getSeconds();
        return order_no;
    }

    //# sourceURL=/view/order/list_order.js
</script>