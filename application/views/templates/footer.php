<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2020 <div class="bullet"></div> Honda Putra Jaya Malang
    </div>
    <div class="footer-right">

    </div>
</footer>
</div>
</div>

<script>
    // Format Rupiah
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    // format tanggal
    function tanggalIndonesia(date) {
        var date = new Date(date);
        var tahun = date.getFullYear();
        var bulan = date.getMonth();
        var tanggal = date.getDate();
        var hari = date.getDay();
        var jam = date.getHours();
        var menit = date.getMinutes();
        var detik = date.getSeconds();
        switch (bulan) {
            case 0:
                bulan = "Januari";
                break;
            case 1:
                bulan = "Februari";
                break;
            case 2:
                bulan = "Maret";
                break;
            case 3:
                bulan = "April";
                break;
            case 4:
                bulan = "Mei";
                break;
            case 5:
                bulan = "Juni";
                break;
            case 6:
                bulan = "Juli";
                break;
            case 7:
                bulan = "Agustus";
                break;
            case 8:
                bulan = "September";
                break;
            case 9:
                bulan = "Oktober";
                break;
            case 10:
                bulan = "November";
                break;
            case 11:
                bulan = "Desember";
                break;
        }
        var tampilTanggal = tanggal + " " + bulan + " " + tahun;

        return tampilTanggal;
    }
</script>

<!-- General JS Scripts -->
<script src="<?= BASE_THEME . '/modules/popper.js' ?>"></script>
<script src="<?= BASE_THEME . '/modules/tooltip.js' ?>"></script>
<script src="<?= BASE_THEME . '/modules/bootstrap/js/bootstrap.min.js' ?>"></script>
<script src="<?= BASE_THEME . '/modules/nicescroll/jquery.nicescroll.min.js' ?>"></script>
<script src="<?= BASE_THEME . '/modules/moment.min.js' ?>"></script>
<script src="<?= BASE_THEME . '/js/stisla.js' ?>"></script>
<script src="<?= BASE_THEME . '/modules/select2/dist/js/select2.full.min.js' ?>"></script>

<!-- datatables -->
<script src="<?= BASE_THEME . '/modules/datatables/datatables.min.js' ?>"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->
<script src="<?= BASE_THEME . '/js/page/index.js' ?>"></script>

<!-- Template JS File -->
<script src="<?= BASE_THEME . '/js/scripts.js' ?>"></script>
<script src="<?= BASE_THEME . '/js/custom.js' ?>"></script>
</body>

</html>