<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">
<h3>Isolasi Tanaman Sekitar</h3>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label for="tanamanUtara" class="form-label">Bagian Utara</label>
            <input type="text" class="form-control" id="tanamanUtara" name="tanaman_utara" required>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="tanamanSelatan" class="form-label">Bagian Selatan</label>
            <input type="text" class="form-control" id="tanamanSelatan" name="tanaman_selatan" required>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="tanamanTimur" class="form-label">Bagian Timur</label>
            <input type="text" class="form-control" id="tanamanTimur" name="tanaman_timur" required>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="tanamanBarat" class="form-label">Bagian Barat</label>
            <input type="text" class="form-control" id="tanamanBarat" name="tanaman_barat" required>
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="bekasBero" class="form-label">Bekas Bero</label>
    <input type="text" class="form-control" id="bekasBero" name="bekas_bero" required>
</div>
<div class="mb-3">
    <label for="kesimpulan" class="form-label">Kesimpulan</label>
    <select class="form-control" id="kesimpulan" name="kesimpulan">
        <option value="Memenuhi">Memenuhi</option>
        <option value="Tidak Memenuhi">Tidak Memenuhi</option>
    </select>
</div>
<button type="button" id="saveFasePendahuluan" class="btn btn-primary">Simpan Data</button>

<script>
    $(document).ready(function() {
        $('#saveFasePendahuluan').click(function() {
            var formData = $('#formfase_pendahuluan').serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/fase_pendahuluan_store',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#modal-fase_pendahuluan').modal('hide');
                    $('#sertifikasiModal{{ $Sertifikasi->id }}').modal('hide');
                    $('#datatable-sertifikasi').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>
