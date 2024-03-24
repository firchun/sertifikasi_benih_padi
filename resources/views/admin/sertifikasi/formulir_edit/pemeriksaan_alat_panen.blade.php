<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">
<input type="hidden" id="idPanen{{ $Sertifikasi->id }}" name="id">

<div class="mb-3">
    <label for="luasPemeriksaan" class="form-label">Luas pemeriksaan fase akhir</label>
    <input type="text" class="form-control" id="luasPemeriksaanPanenEdit-{{ $Sertifikasi->id }}"
        name="luas_pemeriksaan" pattern="[0-9]+(\.[0-9]{1,2})?" required>
</div>
<div class="mb-3">
    <label for="luasPanen" class="form-label">Luas penguasaan lahan panen</label>
    <input type="text" class="form-control" id="luasPanenPanenEdit-{{ $Sertifikasi->id }}" name="luas_panen"
        required>
</div>
<div class="mb-3">
    <label for="hasilPanen" class="form-label">Penguasaan hasil panen</label>
    <input type="text" class="form-control" id="hasilPanenPanenEdit-{{ $Sertifikasi->id }}" name="hasil_panen"
        required>
</div>
<div class="mb-3">
    <label for="campuran" class="form-label">Tercampurnya benih dengan varietas/ tanaman lain/areal non</label>
    <select class="form-control" id="campuran" name="campuran">
        <option value="Ada">Ada</option>
        <option value="Tidak Ada">Tidak Ada</option>
    </select>
</div>

<div class="mb-3">
    <label for="kesimpulan" class="form-label">Kesimpulan</label>
    <select class="form-control" id="kesimpulan" name="kesimpulan">
        <option value="Tidak">Tidak Lulus</option>
        <option value="Lulus">Lulus</option>
    </select>
</div>
<div class="mb-3">
    <label for="catatan" class="form-label">Catatan</label>
    <textarea class="form-control" id="catatanPanenEdit-{{ $Sertifikasi->id }}" name="catatan"></textarea>
</div>
<button type="button" id="saveFasePanenEdit{{ $Sertifikasi->id }}" class="btn btn-warning">Simpan perubahan</button>
<script>
    $(document).ready(function() {
        //simpan form
        $('#saveFasePanenEdit' + {{ $Sertifikasi->id }}).click(function() {
            var formData = $('#formpemeriksaan_alat_panen-edit' + {{ $Sertifikasi->id }}).serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/fase_panen_store',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#modal-edit-pemeriksaan_alat_panen-' + {{ $Sertifikasi->id }})
                        .modal(
                            'hide');
                    $('#sertifikasiModal{{ $Sertifikasi->id }}').modal('hide');
                    $('#datatable-sertifikasi').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    console.log('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>
