<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">
<input type="hidden" id="idPendahuluan{{ $Sertifikasi->id }}" name="id">
<h3>Isolasi Tanaman Sekitar</h3>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label for="tanamanUtara" class="form-label">Bagian Utara</label>
            <input type="text" class="form-control" id="tanamanUtaraEdit-{{ $Sertifikasi->id }}" name="tanaman_utara"
                required>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="tanamanSelatan" class="form-label">Bagian Selatan</label>
            <input type="text" class="form-control" id="tanamanSelatanEdit-{{ $Sertifikasi->id }}"
                name="tanaman_selatan" required>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="tanamanTimur" class="form-label">Bagian Timur</label>
            <input type="text" class="form-control" id="tanamanTimurEdit-{{ $Sertifikasi->id }}" name="tanaman_timur"
                required>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label for="tanamanBarat" class="form-label">Bagian Barat</label>
            <input type="text" class="form-control" id="tanamanBaratEdit-{{ $Sertifikasi->id }}" name="tanaman_barat"
                required>
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="bekasTanaman" class="form-label">Bekas Tanaman</label>
    <input type="text" class="form-control" id="bekasTanamanEdit-{{ $Sertifikasi->id }}" name="bekas_tanam" required>
</div>
<div class="mb-3">
    <label for="bekasBero" class="form-label">Bekas Bero</label>
    <input type="text" class="form-control" id="bekasBeroEdit-{{ $Sertifikasi->id }}" name="bekas_bero" required>
</div>
<div class="row">
    <div class="col">

        <div class="mb-3">
            <label for="nama" class="form-label">Kelas</label>
            <select class="form-select" name="id_kelas_benih_sebelumnya">
                @foreach (App\Models\KelasBenih::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name . ' - ' . $item->code }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col">
        <div class="mb-3">
            <label for="nama" class="form-label">Varietas</label>
            <select class="form-select" name="id_varietas_sebelumnya">
                @foreach (App\Models\varietas::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="kesimpulan" class="form-label">Kesimpulan</label>
    <select class="form-control" id="kesimpulan" name="kesimpulan">
        <option value="Tidak">Tidak Memenuhi</option>
        <option value="Memenuhi">Memenuhi</option>
    </select>
</div>
<button type="button" id="saveFasePendahuluanEdit{{ $Sertifikasi->id }}" class="btn btn-warning">Simpan
    Perubahan</button>

<script>
    $(document).ready(function() {
        $('#saveFasePendahuluanEdit' + {{ $Sertifikasi->id }}).click(function() {
            var formData = $('#formfase_pendahuluan-edit' + {{ $Sertifikasi->id }}).serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/fase_pendahuluan_store',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#modal-edit-fase_pendahuluan-' + {{ $Sertifikasi->id }}).modal(
                        'hide');
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
