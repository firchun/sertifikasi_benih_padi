<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">
<input type="hidden" id="idMasak{{ $Sertifikasi->id }}" name="id">
<div class="mb-3">
    <label for="bekasTanam" class="form-label">Sifat-sifat tanaman sesuai varietasnya</label>
    <select class="form-control" id="sesuaiVarietas" name="sesuai_varietas">
        <option value="Ya">Ya</option>
        <option value="Tidak">Tidak</option>
    </select>
</div>

<div class="mb-3">
    <label for="hamaPenyakit" class="form-label">Keadaan Hama dan Penyakit</label>
    <input type="text" class="form-control" id="hamaPenyakitMasakEdit-{{ $Sertifikasi->id }}" name="hama_penyakit"
        required>
</div>
<div class="mb-3">
    <label for="kemurnian" class="form-label">Tingkat kemurnian di lapangan</label>
    <input type="text" class="form-control" id="kemurnianMasakEdit-{{ $Sertifikasi->id }}" name="kemurnian" required>
</div>
<div class="mb-3">
    <label for="pemeriksaan" class="form-label">Populasi pertanaman tiap contoh pemeriksaan</label>
    <input type="text" class="form-control" id="pemeriksaanMasakEdit-{{ $Sertifikasi->id }}" name="pemeriksaan"
        required>
</div>
<div class="mb-3">
    <label for="keadaanRumput" class="form-label">Keadaan rerumputan</label>
    <input type="text" class="form-control" id="keadaanRumputMasakEdit-{{ $Sertifikasi->id }}" name="keadaan_rumput"
        required>
</div>
<div class="mb-3">
    <label for="taksiranHasil" class="form-label">Taksiran hasil</label>
    <input type="text" class="form-control" id="taksiranHasilMasakEdit-{{ $Sertifikasi->id }}" name="taksiran_hasil"
        required pattern="[0-9]+(\.[0-9]{1,2})?">
</div>
<div class="mb-3">
    <label for="kesimpulan" class="form-label">Kesimpulan</label>
    <select class="form-control" id="kesimpulan" name="kesimpulan">
        <option value="Tidak">Tidak Lulus</option>
        <option value="Lulus">Lulus</option>
    </select>
</div>


<button type="button" id="saveFaseMasakEdit{{ $Sertifikasi->id }}" class="btn btn-warning">Simpan Perubahan</button>
<script>
    $(document).ready(function() {
        //tambah form
        const formContainerMasak = document.getElementById('form-container-Masak');
        let countMasak = 2;

        function addFormMasak() {
            const formGroup = document.createElement('div');
            formGroup.classList.add('form-group', 'd-flex', 'my-2');
            formGroup.innerHTML =
                `
                    <input type="number" name="no[]" placeholder="no" class="form-control mx-2" style="width: 200px;" value="` +
                countMasak + `">
                    <input type="number" placeholder="jumlah" name="jumlah[]" class="form-control mx-2" value="0">
                    <button type="button" class="btn btn-danger btn-sm remove-button-Masak"><i class="bx bx-trash"></i></button>
                    `;
            formContainerMasak.appendChild(formGroup);

            const removeButtonMasak = formGroup.querySelector('.remove-button-Masak');
            removeButtonMasak.addEventListener('click', () => removeFormMasak(formGroup));

            countMasak++; // Increment count after adding form

            resetNumbers(); // Reset numbers after adding form
        }

        function removeFormMasak(formGroup) {
            formGroup.remove();

            resetNumbers(); // Reset numbers after removing form
        }

        function resetNumbers() {
            const formGroups = formContainerMasak.querySelectorAll('.form-group');
            formGroups.forEach((formGroup, index) => {
                const numberInput = formGroup.querySelector('input[name="no[]"]');
                numberInput.value = index + 2; // Set correct number sequence
            });
        }

        const addButtonMasak = document.querySelector('.add-button-Masak');
        addButtonMasak.addEventListener('click', addFormMasak);

        //simpan form
        $('#saveFaseMasakEdit' + {{ $Sertifikasi->id }}).click(function() {
            var formData = $('#formfase_masak-edit' + {{ $Sertifikasi->id }}).serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/fase_masak_store',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#modal-edit-fase_masak-' + {{ $Sertifikasi->id }}).modal('hide');
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
