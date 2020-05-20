<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
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
                            <input type="text" id="nama-produk" class="form-control" style="width:20%" placeholder="Cari Nama Produk">
                            <input type="text" class="form-control filter_single" style="width:30%" id="tanggal_penjualan" placeholder="Pilih Periode">
                        </div>
                    </div>
                    <div>
                        <div class="table-group" style="margin-top:50px;">
                            <table class="table" id="list_laporan" style="border-collapse: separate !important; font-size:16px !important; ">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th style="width: 45%">Nama Produk</th>
                                        <th style="width: 15%">Total Penjualan</th>
                                        <th style="width: 25%">Total Pemasukan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    var date = new Date();
    var month = date.getMonth() < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1);
    var start_month = date.getFullYear() + "-" + month + "-" + '01' + ' 00:00:00';
    var end_month = date.getFullYear() + "-" + month + "-" + '31' + ' 23:23:59';

    $(document).ready(function() {
        $('.filter_single').datepicker({
            endDate: '+0y',
            format: "MM yyyy",
            viewMode: "months",
            minViewMode: "months"
        }).on('changeDate', function(ev) {
            $(this).datepicker('hide');
        });

        $('#tanggal_penjualan').change(function() {
            date = new Date($('#tanggal_penjualan').val());
            month = date.getMonth() < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1);
            start_month = date.getFullYear() + "-" + month + "-" + '01' + ' 00:00:00';
            end_month = date.getFullYear() + "-" + month + "-" + '31' + ' 23:23:59';
            show_data_laporan();
        });

        // membuat datatable order
        $('#list_laporan').dataTable();
        $('#list_laporan_filter').hide();
        $('#list_laporan_length').hide();
        show_data_laporan();

        $('#nama-produk').keyup(function() {
            show_data_laporan();
        });

    })

    // menampilkan data customer
    function show_data_laporan() {
        var nomor = 1;
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Laporan/getListPesanan" ?>',
            data: {
                nama_produk: $('#nama-produk').val(),
                start_month: start_month,
                end_month: end_month
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $("#list_laporan").dataTable().fnClearTable();
                for (i = 0; i < data.length; i++) {
                    var dataCust = [
                        data[i]['nama_produk'],
                        data[i]['total_jual'] == null ? 0 : formatRupiah(data[i]['total_jual']),
                        data[i]['total_pemasukan'] == null ? 0 : formatRupiah(data[i]['total_pemasukan'], 'Rp'),
                    ]
                    $("#list_laporan").dataTable().fnAddData(dataCust);
                }
            }

        });
    }

    //# sourceURL=/view/ahass/laporan.js
</script>