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
                            <input type="text" id="nama-pengguna" class="form-control" style="width:20%" placeholder="Masukkan Nama Pengguna">
                            <select class="form-control" id="role">
                                <option value="">Semua Peran</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="montir">Montir</option>
                                <option value="manager">Manager</option>
                            </select>
                            <div class="btn float-right">
                                <a href="#" class="btn btn-danger" onclick="tambahOrder()">
                                    Tambah Pengguna
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="table-group" style="margin-top:50px;">
                            <table class="table" id="list_pengguna" style="border-collapse: separate !important; font-size:16px !important; text-transform: capitalize">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Nama Pengguna</th>
                                        <th style="width: 20%;">Role</th>
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
                                <label class="control-label label-form">Nama Pengguna</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="fullname" id="fullname" placeholder="Masukkan Nama Pengguna">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Peran Pengguna</label>
                                <select class="form-control" id="role_tambah">
                                    <option value="" selected disabled>Pilih Peran</option>
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="montir">Montir</option>
                                    <option value="manager">Manager</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Username</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="username" id="username" placeholder="Masukkan Username">
                                <span class="float-left" style="font-size: 10px;" id="pesan_username"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Kata Sandi</label>
                                <input type="text" required="required" class="form-control form-modal" name="password" id="password" placeholder="Masukkan Kata Sandi">
                            </div>
                            <div class="form-group float-right">
                                <a href="#" class="btn btn-danger" id="tambah-penguna" style="width: 140px;">SIMPAN</a>
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
        // $("#role").select2();
        // membuat datatable order
        $('#list_pengguna').dataTable();
        $('#list_pengguna_filter').hide();
        $('#list_pengguna_length').hide();
        show_data_user();

        $('#nama-pengguna').keyup(function() {
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
            url: '<?= BASE_URL . "Pengguna/getListPengguna" ?>',
            data: {
                nama_pengguna: $('#nama-pengguna').val(),
                role: $('#role').val() == '' ? null : $('#role').val()
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $("#list_pengguna").dataTable().fnClearTable();
                for (i = 0; i < data.length; i++) {
                    var dataCust = [
                        nomor++,
                        data[i]['fullname'],
                        data[i]['role'],
                        // '<a href="<?= BASE_URL . "Order/detail/" ?>' + data[i]['nomor_order'] + '" class="btn btn-danger" style="width: 100%;">Detail</a>'
                    ]
                    $("#list_pengguna").dataTable().fnAddData(dataCust);
                }
            }
        });
    }

    // fitur pencarian nomor order
    $('#username').keyup(function() {
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Pengguna/checkUsername" ?>',
            data: {
                username: $('#username').val(),
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data['status'] == 'error') {
                    $('#pesan_username').text('✕ Username Telah Digunakan').css('color', 'red');
                } else {
                    $('#pesan_username').text('✓ Username Dapat Digunakan').css('color', 'green');
                }
            },
            error: function(xhr) {

            }
        });
    });

    function tambahOrder() {
        $("form[name='form-tambah-order']")
            .closest("form")
            .trigger("reset");
        $("#modal-tambah-order").modal("show");
    }

    // melakukan tambah penguna
    $("#tambah-penguna").click(function(e) {
        e.preventDefault();

        var fullname = $('#fullname').val();
        var role = $('#role_tambah').val();
        var username = $('#username').val();
        var password = $('#password').val();

        if (fullname && role_tambah && username && password) {

            $.ajax({
                type: "POST",
                url: '<?= BASE_URL . "Pengguna/setDataPengguna" ?>',
                data: {
                    fullname: fullname,
                    role: role,
                    username: username,
                    password: password
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
            $('#modal-tambah-order').animate({
                scrollTop: 0
            }, 'slow');
            $("#alertFadeOut").fadeOut(5000);
        }
    });
</script>