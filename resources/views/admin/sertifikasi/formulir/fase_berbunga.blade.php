<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">

<div class="mb-3">
    <label for="bekasTanam" class="form-label">Sifat-sifat tanaman sesuai varietasnya</label>
    <select class="form-control" id="sesuaiVarietas" name="sesuai_varietas">
        <option value="Ya">Ya</option>
        <option value="Tidak">Tidak</option>
    </select>
</div>

<div class="mb-3">
    <label for="hamaPenyakit" class="form-label">Keadaan Hama dan Penyakit</label>
    <input type="text" class="form-control" id="hamaPenyakit" name="hama_penyakit" required>
</div>
<div class="mb-3">
    <label for="kemurnian" class="form-label">Tingkat kemurnian di lapangan</label>
    <input type="text" class="form-control" id="kemurnian" name="kemurnian" required>
</div>
<div class="mb-3">
    <label for="pemeriksaan" class="form-label">Populasi pertanaman tiap contoh pemeriksaan</label>
    <input type="text" class="form-control" id="pemeriksaan" name="pemeriksaan" required>
</div>
<div class="mb-3">
    <label for="keadaanRumput" class="form-label">Keadaan rerumputan</label>
    <input type="text" class="form-control" id="keadaanRumput" name="keadaan_rumput" required>
</div>
<div class="mb-3">
    <label for="taksiranHasil" class="form-label">Taksiran hasil</label>
    <input type="text" class="form-control" id="taksiranHasil" name="taksiran_hasil" required>
</div>
<div class="mb-3">
    <label for="kesimpulan" class="form-label">Kesimpulan</label>
    <select class="form-control" id="kesimpulan" name="kesimpulan">
        <option value="Memenuhi">Memenuhi</option>
        <option value="Tidak Memenuhi">Tidak Memenuhi</option>
    </select>
</div>
<div class="form-group mb-4" id="form-container-berbunga">
    <label class="mb-3">Campuran Varietas Lain</label>
    <div class="d-flex">
        <input type="number" name="no[]" placeholder="no" class="form-control mx-2" style="width: 200px;"
            value="1">
        <input type="number" placeholder="jumlah" name="jumlah[]" class="form-control mx-2" value="0">
        <button type="button" class="btn btn-sm btn-primary add-button"><i class="bx bx-plus"></i></button>
    </div>
</div>
<button type="button" id="saveFaseBerbunga" class="btn btn-primary">Simpan Data</button>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formContainerBerbunga = document.getElementById('form-container-berbunga');

        function addForm() {
            const formGroup = document.createElement('div');
            formGroup.classList.add('form-group', 'd-flex', 'my-2');
            formGroup.innerHTML =
                `
            <input type="number" name="no[]" placeholder="no" class="form-control mx-2" style="width: 200px;" value="` +
                (document.querySelectorAll('.form-group').length + 1) + `">
        <input type="number" placeholder="jumlah" name="jumlah[]" class="form-control mx-2" value="0">
                <button type="button" class="btn btn-danger btn-sm remove-button"><i class="bx bx-trash"></i></button>
            `;
            formContainerBerbunga.appendChild(formGroup);

            const removeButton = formGroup.querySelector('.remove-button');
            removeButton.addEventListener('click', () => removeForm(formGroup));
        }

        function removeForm(formGroup) {
            formGroup.remove();
        }

        const addButton = document.querySelector('.add-button');
        addButton.addEventListener('click', addForm);

    });


    $(document).ready(function() {
        $('#saveFaseBerbunga').click(function() {
            var formData = $('#formfase_berbunga').serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/fase_berbunga_store',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#modal-fase_berbunga').modal('hide');
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
