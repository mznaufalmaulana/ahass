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
                            <input type="text" id="nama-produk" class="form-control" style="width:20%" placeholder="Masukkan Nama Produk">
                            <div class="btn float-right">
                                <a href="#" class="btn btn-danger" onclick="tambahProduk()">
                                    Tambah Produk
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="message"></div>
                    <div>
                        <div class="table-group" style="margin-top:50px;">
                            <table class="table" id="list_produk" style="border-collapse: separate !important; font-size:16px !important; text-transform: capitalize">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Nama Produk</th>
                                        <th style="width: 20%;">Harga</th>
                                        <!-- <th style="width: 20%;"></th> -->
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
<div class="modal fade" id="modal-tambah-produk" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="message-error"></div>
                        <form style="margin-bottom:30px;" enctype="multipart/form-data" action="" name="form-tambah-produk">
                            <div class="form-group">
                                <label class="control-label label-form">Nama Produk</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="nama-produk-tambah" id="nama-produk-tambah" placeholder="Masukkan Nama Produk">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Harga</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="harga" id="harga" placeholder="Masukkan Harga">
                            </div>
                            <div class="form-group float-right">
                                <a href="#" class="btn btn-danger" id="tambah-produk" style="width: 140px;">SIMPAN</a>
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
    $(document).ready(function() {
        // membuat datatable order
        $('#list_produk').dataTable();
        $('#list_produk_filter').hide();
        $('#list_produk_length').hide();
        show_data_user();

        $('#nama-produk').keyup(function() {
            show_data_user();
        });

        $('#role').change(function() {
            show_data_user();
        });
    })

    // menampilkan data customer
    function show_data_user() {
        var nomor = 1;
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Produk/getListProduk" ?>',
            data: {
                nama_produk: $('#nama-produk').val()
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $("#list_produk").dataTable().fnClearTable();
                for (i = 0; i < data.length; i++) {
                    var dataCust = [
                        nomor++,
                        data[i]['nama_produk'],
                        formatRupiah(data[i]['harga'], 'Rp'),
                        // '<a href="<?= BASE_URL . "Order/detail/" ?>' + data[i]['nomor_order'] + '" class="btn btn-danger" style="width: 100%;">Detail</a>'
                    ]
                    $("#list_produk").dataTable().fnAddData(dataCust);
                }
            }
        });
    }

    function tambahProduk() {
        $("form[name='form-tambah-produk']")
            .closest("form")
            .trigger("reset");
        $("#modal-tambah-produk").modal("show");
    }

    // melakukan tambah penguna
    $("#tambah-produk").click(function(e) {
        e.preventDefault();

        var id = create_UUID();
        var nama_produk = $('#nama-produk-tambah').val();
        var harga = $('#harga').val();

        if (nama_produk && harga) {

            $.ajax({
                type: "POST",
                url: '<?= BASE_URL . "Produk/setDataProduk" ?>',
                data: {
                    id: id,
                    nama_produk: nama_produk,
                    harga: harga
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
                    $("#modal-tambah-produk").modal("hide");
                    $("form[name='form-tambah-produk']")
                        .closest("form")
                        .trigger("reset");
                    show_data_user();
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
            $('#modal-tambah-produk').animate({
                scrollTop: 0
            }, 'slow');
            $("#alertFadeOut").fadeOut(5000);
        }
    });

    //# sourceURL=/view/produk/produk.js
</script>