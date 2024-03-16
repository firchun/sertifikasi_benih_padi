<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">
<input type="hidden" id="id" name="id">
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="nomorInduk" class="form-label">Nomor Induk</label>
            <input type="text" class="form-control" id="nomorInduk" name="nomor_induk" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">

        <div class="mb-3">
            <label for="musimTanam" class="form-label">Musim Tanam</label>
            <input type="text" class="form-control" id="musimTanam" name="musim_tanam" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="nomotKelompok" class="form-label">Nomor Kelompok</label>
            <input type="text" class="form-control" id="nomotKelompok" name="nomor_kelompok" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="tanggalPanen" class="form-label">Tanggal Panen</label>
            <input type="date" class="form-control" id="tanggalPanen" name="tanggal_panen" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="tanggalLabel" class="form-label">Tanggal Label</label>
            <input type="date" class="form-control" id="tanggalLabel" name="tanggal_label" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="tanggalSelesaiPengujian" class="form-label">Tanggal Selesai Pengujian</label>
            <input type="date" class="form-control" id="tanggalSelesaiPengujian" name="tanggal_selesai_pengujian"
                required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="campuranVarietasLain" class="form-label">Campuran Varietas Lain</label>
            <input type="number" class="form-control" id="campuranVarietasLain" name="campuran_varietas_lain" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="volume" class="form-label">Volume</label>
            <input type="number" class="form-control" id="volume" name="volume" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="kadarAir" class="form-label">Kadar Air</label>
            <input type="number" class="form-control" id="kadarAir" name="kadar_air" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="benihMurni" class="form-label">Benih Murni</label>
            <input type="number" class="form-control" id="benihMurni" name="benih_murni" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="kotoranBenih" class="form-label">Kotoran Benih</label>
            <input type="number" class="form-control" id="kotoranBenih" name="kotoran_benih" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="dayaBerkecambah" class="form-label">Daya Berkecambah</label>
            <input type="number" class="form-control" id="dayaBerkecambah" name="daya_berkecambah" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="kesehatanBenih" class="form-label">Kesehatan Benih</label>
            <input type="number" class="form-control" id="kesehatanBenih" name="kesehatan_benih" required>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="mb-3">
            <label for="bijiGulma" class="form-label">Biji Gulma</label>
            <input type="number" class="form-control" id="bijiGulma" name="biji_gulma" required>
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
                <option value="Tidak">Tidak Lulus Sertifikasi</option>
                <option value="Lulus">Lulus Sertifikasi</option>
            </select>
        </div>
    </div>
</div>
<button class="btn btn-primary" type="button" id="saveUjiLaboratoriumEdit{{ $Sertifikasi->id }}">Simpan
    Perubahan</button>
<script>
    $(document).ready(function() {
        //simpan form
        $('#saveUjiLaboratoriumEdit' + {{ $Sertifikasi->id }}).click(function() {
            var formData = $('#form-uji-laboratorium-edit' + {{ $Sertifikasi->id }}).serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/uji_laboratorium',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
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
