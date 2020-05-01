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
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nomor Order
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="outlet_detail">ORD202019192882</span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nama
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="outlet_detail">Mat Bayan</span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nomor Telepon
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail">0878566666666</span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nomor Polisi
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail">M 5252 AAE</span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Kilometer
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail">39.900 Km</span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Jenis Service
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail">KPB 3</span></div>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
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
                                        <th><a href="#" class="btn btn-danger" style="width: 100%;">Detail</a></th>
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
                                        <button class="btn btn-danger"><i class="fas fa-plus"></i></button>
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