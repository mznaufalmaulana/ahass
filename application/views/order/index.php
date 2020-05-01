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
                    <div>
                        <div class="table-group">
                            <table class="table" id="list_customer" style="border-collapse: separate !important; font-size:16px !important; ">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th>No Order</th>
                                        <th style="width: 25%">Tanggal Order</th>
                                        <th>Nama Pelanggan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody syle="font-weight: normal;">
                                    <tr>
                                        <th>123-456-789</th>
                                        <th>22 Juni 2020</th>
                                        <th>Jony</th>
                                        <th><a href="<?= BASE_URL . 'Order/detail' ?>" class="btn btn-danger" style="width: 100%;">Detail</a></th>
                                    </tr>
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
                        <form style="margin-bottom:30px;" enctype="multipart/form-data" action="" name="form-tambah-order">
                            <div class="form-group">
                                <label class="control-label label-form">Nomor Order</label>
                                <input type="text" required="required" class="form-control form-modal" name="order_no" id="order_no" placeholder="Masukkan Nomor Order" value="<?= 'ORD' . date("Ymdhis") ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Nama Pelanggan</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="cust_name" id="cust_name" placeholder="Masukkan Nama Pelanggan">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Nomor Telepon</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="telepon_no" id="telepon_no" placeholder="Masukkan Telepon">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Nomor Polisi</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="plat_no" id="plat_no" placeholder="Masukkan Nomor Polisi">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Rekap Kilometer</label>
                                <input maxlength="100" type="text" required="required" class="form-control form-modal" name="kilometer" id="kilometer" placeholder="Masukkan Kilometer">
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Jenis Servis</label>
                                <select name="jenis_servis" id="jenis_servis" class="form-control form-modal">
                                    <option value="" selected disabled>Pilih Jenis Servis</option>
                                    <option value="KPB_1">KPB 1</option>
                                    <option value="KPB_2">KPB 2</option>
                                    <option value="KPB_3">KPB 3</option>
                                    <option value="KPB_4">KPB 4</option>
                                    <option value="Lainnya">Servis Berkala</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label label-form">Jasa / Sparepart</label>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <select name="area_edit" id="area_edit" class="form-control form-modal">
                                            <option value="" selected disabled>Pilih Jenis / Sparepart</option>
                                            <option value="Jasa_1">Jasa 1</option>
                                            <option value="Jasa_2">Jasa 2</option>
                                            <option value="Jasa_3">Jasa 3</option>
                                            <option value="Jasa_4">Jasa 4</option>
                                            <option value="Barang_1">Barang 1</option>
                                            <option value="Barang_2">Barang 2</option>
                                            <option value="Barang_3">Barang 3</option>
                                            <option value="Barang_4">Barang 4</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number" required="required" class="form-control form-modal" name="kilometer" id="kilometer" placeholder="Jumlah" min="0">
                                    </div>
                                    <div class="col-lg-1">
                                        <a href="#" id="tambah-pesanan" class="btn btn-danger"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <a href="#" class="btn btn-danger" id="edit_user" style="width: 140px;">SIMPAN</a>
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
            dataTable.ajax.reload();
        });

        $('#filter').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');

            tgl_mulai_filter = '';
            tgl_akhir_filter = '';
            dataTable.ajax.reload();
        });
    })

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
</script>