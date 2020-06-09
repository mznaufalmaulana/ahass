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
                            <input type="text" class="form-control" style="width:30%" id="filter" placeholder="Pilih Tanggal">
                        </div>
                    </div>
                    <div>
                        <div class="table-group" style="margin-top:50px;">
                            <table class="table" id="list_laporan" style="border-collapse: separate !important; font-size:16px !important; ">
                                <thead syle="font-weight: normal;">
                                    <tr>
                                        <th style="width: 75%">Tanggal Laporan</th>
                                        <th style="width: 25%">Aksi</th>
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
    var tgl_mulai_filter;
    var tgl_akhir_filter;
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
            show_data_laporan();
        });

        $('#filter').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');

            tgl_mulai_filter = '';
            tgl_akhir_filter = '';
            show_data_laporan();
        });

        // membuat datatable order
        $('#list_laporan').dataTable();
        $('#list_laporan_filter').hide();
        $('#list_laporan_length').hide();
        show_data_laporan();

    })

    // menampilkan data laporan penjualan
    function show_data_laporan() {
        var nomor = 1;
        $.ajax({
            type: 'POST',
            url: '<?= BASE_URL . "Validasi/getListLaporan" ?>',
            data: {
                start_month: tgl_mulai_filter,
                end_month: tgl_akhir_filter
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $("#list_laporan").dataTable().fnClearTable();
                for (i = 0; i < data.length; i++) {
                    var dataCust = [
                        tanggalIndonesia(data[i]['tanggal_pembelian']),
                        '<a href="<?= BASE_URL . "Validasi/detail/" ?>' + data[i]['tanggal_pembelian'] + '" class="btn btn-danger" style="width: 100%;">Detail</a>'
                    ]
                    $("#list_laporan").dataTable().fnAddData(dataCust);
                }
            }

        });
    }

    //# sourceURL=/view/ahass/laporan.js
</script>