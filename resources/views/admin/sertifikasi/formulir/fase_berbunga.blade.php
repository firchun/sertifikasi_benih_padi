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
    <input type="text" class="form-control" id="hamaPenyakit-{{ $Sertifikasi->id }}" name="hama_penyakit" required>
</div>
<div class="mb-3">
    <label for="kemurnian" class="form-label">Tingkat kemurnian di lapangan</label>
    <input type="text" class="form-control" id="kemurnian-{{ $Sertifikasi->id }}" name="kemurnian" required>
</div>
<div class="mb-3">
    <label for="pemeriksaan" class="form-label">Populasi pertanaman tiap contoh pemeriksaan</label>
    <input type="text" class="form-control" id="pemeriksaan-{{ $Sertifikasi->id }}" name="pemeriksaan" required>
</div>
<div class="mb-3">
    <label for="keadaanRumput" class="form-label">Keadaan rerumputan</label>
    <input type="text" class="form-control" id="keadaanRumput-{{ $Sertifikasi->id }}" name="keadaan_rumput" required>
</div>
<div class="mb-3">
    <label for="taksiranHasil" class="form-label">Taksiran hasil</label>
    <input type="number" class="form-control" id="taksiranHasil-{{ $Sertifikasi->id }}" name="taksiran_hasil" required>
</div>
<div class="mb-3">
    <label for="kesimpulan" class="form-label">Kesimpulan</label>
    <select class="form-control" id="kesimpulan-{{ $Sertifikasi->id }}" name="kesimpulan">
        <option value="Tidak">Tidak Lulus</option>
        <option value="Lulus">Lulus</option>
    </select>
</div>
<div class="form-group mb-4" id="form-container-Berbunga-{{ $Sertifikasi->id }}">
    <label class="mb-3">Campuran Varietas Lain</label>
    <div class="d-flex">
        <input type="number" name="no[]" placeholder="no" class="form-control mx-2" style="width: 200px;"
            value="1">
        <input type="number" placeholder="jumlah" name="jumlah[]" class="form-control mx-2" value="0">
        <button type="button" class="btn btn-sm btn-primary add-button-Berbunga-{{ $Sertifikasi->id }}"><i
                class="bx bx-plus"></i></button>
    </div>
</div>
<div class="mb-3">
    <label for="catatan" class="form-label">Catatan</label>
    <textarea class="form-control" id="catatan-{{ $Sertifikasi->id }}" name="catatan"></textarea>
</div>
<button type="button" id="saveFaseBerbunga-{{ $Sertifikasi->id }}" class="btn btn-primary">Simpan Data</button>
<script>
    $(document).ready(function() {
        //tambah form
        const formContainerBerbunga = document.getElementById(
            'form-container-Berbunga-{{ $Sertifikasi->id }}');
        let countBerbunga = 2;

        function addFormBerbunga() {
            const formGroup = document.createElement('div');
            formGroup.classList.add('form-group', 'd-flex', 'my-2');
            formGroup.innerHTML =
                `
                    <input type="number" name="no[]" placeholder="no" class="form-control mx-2" style="width: 200px;" value="` +
                countBerbunga + `">
                    <input type="number" placeholder="jumlah" name="jumlah[]" class="form-control mx-2" value="0">
                    <button type="button" class="btn btn-danger btn-sm remove-button-Berbunga"><i class="bx bx-trash"></i></button>
                    `;
            formContainerBerbunga.appendChild(formGroup);

            const removeButtonBerbunga = formGroup.querySelector('.remove-button-Berbunga');
            removeButtonBerbunga.addEventListener('click', () => removeFormBerbunga(formGroup));

            countBerbunga++; // Increment count after adding form

            resetNumbers(); // Reset numbers after adding form
        }

        function removeFormBerbunga(formGroup) {
            formGroup.remove();

            resetNumbers(); // Reset numbers after removing form
        }

        function resetNumbers() {
            const formGroups = formContainerBerbunga.querySelectorAll('.form-group');
            formGroups.forEach((formGroup, index) => {
                const numberInput = formGroup.querySelector('input[name="no[]"]');
                numberInput.value = index + 2; // Set correct number sequence
            });
        }

        const addButtonBerbunga = document.querySelector('.add-button-Berbunga-{{ $Sertifikasi->id }}');
        addButtonBerbunga.addEventListener('click', addFormBerbunga);

        //simpan form
        $('#saveFaseBerbunga-{{ $Sertifikasi->id }}').click(function() {
            var formData = $('#formfase_berbunga-{{ $Sertifikasi->id }}').serialize();
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
                    console.log('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>
