<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">
<input type="hidden" id="idUjiLab{{ $Sertifikasi->id }}" name="id">
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="nomorInduk" class="form-label">Nomor Induk</label>
            <input type="text" class="form-control" id="nomorInduk-{{ $Sertifikasi->id }}" name="nomor_induk"
                required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="nomorSertifikat" class="form-label">Nomor Sertifikat</label>
            <input type="text" class="form-control" id="nomorSertifikat-{{ $Sertifikasi->id }}"
                name="nomor_sertifikat" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">

        <div class="mb-3">
            <label for="musimTanam" class="form-label">Musim Tanam</label>
            <input type="text" class="form-control" id="musimTanam-{{ $Sertifikasi->id }}" name="musim_tanam"
                required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="nomorKelompok" class="form-label">Nomor Kelompok</label>
            <input type="text" class="form-control" id="nomorKelompok-{{ $Sertifikasi->id }}" name="nomor_kelompok"
                required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="tanggalPanen" class="form-label">Tanggal Panen</label>
            <input type="date" class="form-control" id="tanggalPanen-{{ $Sertifikasi->id }}" name="tanggal_panen"
                required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="tanggalPemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
            <input type="date" class="form-control" id="tanggalPemeriksaan-{{ $Sertifikasi->id }}"
                name="tanggal_pemeriksaan" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="tanggalLabel" class="form-label">Tanggal batas Label</label>
            <input type="date" class="form-control" id="tanggalLabel-{{ $Sertifikasi->id }}" name="tanggal_label"
                required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="tanggalSelesaiPengujian" class="form-label">Tanggal Selesai Pengujian</label>
            <input type="date" class="form-control" id="tanggalSelesaiPengujian-{{ $Sertifikasi->id }}"
                name="tanggal_selesai_pengujian" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="campuranVarietasLain" class="form-label">Campuran Varietas Lain</label>
            <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" class="form-control"
                id="campuranVarietasLain-{{ $Sertifikasi->id }}" name="campuran_varietas_lain" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="volume" class="form-label">Volume</label>
            <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" class="form-control"
                id="volume-{{ $Sertifikasi->id }}" name="volume" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="kadarAir" class="form-label">Kadar Air</label>
            <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" class="form-control"
                id="kadarAir-{{ $Sertifikasi->id }}" name="kadar_air" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="benihMurni" class="form-label">Benih Murni</label>
            <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" class="form-control"
                id="benihMurni-{{ $Sertifikasi->id }}" name="benih_murni" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="kotoranBenih" class="form-label">Kotoran Benih</label>
            <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" class="form-control"
                id="kotoranBenih-{{ $Sertifikasi->id }}" name="kotoran_benih" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="dayaBerkecambah" class="form-label">Daya Berkecambah</label>
            <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" class="form-control"
                id="dayaBerkecambah-{{ $Sertifikasi->id }}" name="daya_berkecambah" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="kesehatanBenih" class="form-label">Kesehatan Benih</label>
            <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" class="form-control"
                id="kesehatanBenih-{{ $Sertifikasi->id }}" name="kesehatan_benih" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="bijiGulma" class="form-label">Biji Gulma</label>
            <input type="text" pattern="[0-9]+(\.[0-9]{1,2})?" class="form-control"
                id="bijiGulma-{{ $Sertifikasi->id }}" name="biji_gulma" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="bijiGulma" class="form-label">Label</label>
            <select class="form-control" name="label" id="label">
                <option value="Kuning">Kuning</option>
                <option value="Putih">Putih</option>
                <option value="Ungu">Ungu</option>
                <option value="Biru">Biru</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="bijiGulma" class="form-label">Kesimpulan</label>
            <select class="form-control" name="kesimpulan" id="kesimpulan">
                <option value="Lulus">Lulus Sertifikasi</option>
                <option value="Tidak">Tidak Lulus Sertifikasi</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatanLabEdit-{{ $Sertifikasi->id }}" name="catatan"></textarea>
        </div>
    </div>
</div>
<button class="btn btn-warning" type="button" id="saveUjiLaboratoriumEdit{{ $Sertifikasi->id }}">Simpan
    Perubahan</button>
<script>
    $(document).ready(function() {
        //simpan form
        $('#saveUjiLaboratoriumEdit' + {{ $Sertifikasi->id }}).click(function() {
            var formData = $('#form-edit-uji-laboratorium-{{ $Sertifikasi->id }}').serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/uji_laboratorium',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#modal-edit-uji-lab-{{ $Sertifikasi->id }}').modal('hide');
                    $('#modal-uji-lab-{{ $Sertifikasi->id }}').modal('hide');
                    $('#datatable-sertifikasi').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    console.log('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>
