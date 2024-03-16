<script>
    $(function() {
        window.cetakSertifikat = function(id) {
            window.open("{{ url('sertifikasi/cetak_sertifikat/') }}/" + id, "_blank");
        };
        window.cetakLabel = function(id) {
            window.open("{{ url('sertifikasi/cetak_label/') }}/" + id, "_blank");
        };
    });
</script>
