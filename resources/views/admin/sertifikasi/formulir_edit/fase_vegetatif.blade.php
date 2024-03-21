<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">
<input type="hidden" id="idVegetatif{{ $Sertifikasi->id }}" name="id">
<div class="mb-3">
    <label for="bekasTanam" class="form-label">Sifat-sifat tanaman sesuai varietasnya</label>
    <select class="form-control" id="sesuaiVarietas" name="sesuai_varietas">
        <option value="Ya">Ya</option>
        <option value="Tidak">Tidak</option>
    </select>
</div>

<div class="mb-3">
    <label for="hamaPenyakit" class="form-label">Keadaan Hama dan Penyakit</label>
    <input type="text" class="form-control" id="hamaPenyakitEdit-{{ $Sertifikasi->id }}" name="hama_penyakit"
        required>
</div>
<div class="mb-3">
    <label for="kemurnian" class="form-label">Tingkat kemurnian di lapangan</label>
    <input type="text" class="form-control" id="kemurnianEdit-{{ $Sertifikasi->id }}" name="kemurnian" required>
</div>
<div class="mb-3">
    <label for="pemeriksaan" class="form-label">Populasi pertanaman tiap contoh pemeriksaan</label>
    <input type="text" class="form-control" id="pemeriksaanEdit-{{ $Sertifikasi->id }}" name="pemeriksaan" required>
</div>
<div class="mb-3">
    <label for="keadaanRumput" class="form-label">Keadaan rerumputan</label>
    <input type="text" class="form-control" id="keadaanRumputEdit-{{ $Sertifikasi->id }}" name="keadaan_rumput"
        required>
</div>
<div class="mb-3">
    <label for="taksiranHasil" class="form-label">Taksiran hasil</label>
    <input type="number" class="form-control" id="taksiranHasilEdit-{{ $Sertifikasi->id }}" name="taksiran_hasil"
        required>
</div>
<div class="mb-3">
    <label for="kesimpulan" class="form-label">Kesimpulan</label>
    <select class="form-control" id="kesimpulan" name="kesimpulan">
        <option value="Tidak">Tidak Lulus</option>
        <option value="Lulus">Lulus</option>
    </select>
</div>


<button type="button" id="saveFaseVegetatifEdit{{ $Sertifikasi->id }}" class="btn btn-warning">Simpan
    Perubahan</button>
<script>
    $(document).ready(function() {
        //tambah form
        const formContainerVegetatif = document.getElementById('form-container-vegetatif');
        let countVegetatif = 2;

        function addFormVegetatif() {
            const formGroup = document.createElement('div');
            formGroup.classList.add('form-group', 'd-flex', 'my-2');
            formGroup.innerHTML =
                `
                    <input type="number" name="no[]" placeholder="no" class="form-control mx-2" style="width: 200px;" value="` +
                countVegetatif + `">
                    <input type="number" placeholder="jumlah" name="jumlah[]" class="form-control mx-2" value="0">
                    <button type="button" class="btn btn-danger btn-sm remove-button-vegetatif"><i class="bx bx-trash"></i></button>
                    `;
            formContainerVegetatif.appendChild(formGroup);

            const removeButtonVegetatif = formGroup.querySelector('.remove-button-vegetatif');
            removeButtonVegetatif.addEventListener('click', () => removeFormVegetatif(formGroup));

            countVegetatif++; // Increment count after adding form

            resetNumbers(); // Reset numbers after adding form
        }

        function removeFormVegetatif(formGroup) {
            formGroup.remove();

            resetNumbers(); // Reset numbers after removing form
        }

        function resetNumbers() {
            const formGroups = formContainerVegetatif.querySelectorAll('.form-group');
            formGroups.forEach((formGroup, index) => {
                const numberInput = formGroup.querySelector('input[name="no[]"]');
                numberInput.value = index + 2; // Set correct number sequence
            });
        }

        const addButtonVegetatif = document.querySelector('.add-button-vegetatif');
        addButtonVegetatif.addEventListener('click', addFormVegetatif);

        //simpan form
        $('#saveFaseVegetatifEdit' + {{ $Sertifikasi->id }}).click(function() {
            var formData = $('#formfase_vegetatif-edit' + {{ $Sertifikasi->id }}).serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/fase_vegetatif_store',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#modal-edit-fase_vegetatif-' + {{ $Sertifikasi->id }}).modal(
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