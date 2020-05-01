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
                            <input placeholder="Pilih Tanggal" type="text" id="tgl_filter" class="form-control filter">
                        </div>
                    </div>
                    <div>
                        <div class="table-group" style="margin-top:50px;">
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