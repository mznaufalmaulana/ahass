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
                        <div class="col-lg-3"></div>
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
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail"><?= $dataKustomer[0]->telepon ?></span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Nomor Polisi
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span class="text-uppercase" id="username_detail"><?= $dataKustomer[0]->nomor_polisi ?></span></div>
                            </div>
                            <div class="card-text" style="margin-bottom: 10px;">
                                Kilometer
                                <div class="float-right" style="color: #666666; font-weight: bold; display: inline-block;"><span id="username_detail"><?= ribuan($dataKustomer[0]->total_km) ?> Km</span></div>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    <div>
                        <div class="table-group">
                            <table class="table" id="list_customer" style="border-collapse: separate !important; font-size:16px !important; ">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 25%">Jenis Service</th>
                                        <th style="width: 45%">Proses</th>
                                        <th style="width: 25%">Status</th>
                                    </tr>
                                </thead>
                                <tbody syle="font-weight: normal;">
                                    <tr>
                                        <th class="text-center">1</th>
                                        <th>Tambah Oli</th>
                                        <th>
                                            <div class="progress" data-height="4" data-toggle="tooltip" title="50%">
                                                <div class="progress-bar bg-warning" role="progressbar" data-width="50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="text-warning">Sedang dikerjakan</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">1</th>
                                        <th>Tambah Oli</th>
                                        <th>
                                            <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                                <div class="progress-bar bg-danger" role="progressbar" data-width="0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="text-danger">Dalam antrian</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">1</th>
                                        <th>Tambah Oli</th>
                                        <th>
                                            <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                                <div class="progress-bar bg-success" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </th>
                                        <th class="text-success">Selesai</th>
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