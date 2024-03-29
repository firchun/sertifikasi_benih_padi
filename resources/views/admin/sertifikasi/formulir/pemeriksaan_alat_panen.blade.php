<input type="hidden" id="idSertifikasi" name="id_sertifikasi" value="{{ $Sertifikasi->id }}">


<div class="mb-3">
    <label for="luasPemeriksaan" class="form-label">Luas pemeriksaan fase akhir</label>
    <input type="text" class="form-control" id="luasPemeriksaan-{{ $Sertifikasi->id }}" name="luas_pemeriksaan"
        pattern="[0-9]+(\.[0-9]{1,2})?" required>
</div>
<div class="mb-3">
    <label for="luasPanen" class="form-label">Luas penguasaan lahan panen</label>
    <input type="text" class="form-control" id="luasPanen-{{ $Sertifikasi->id }}" name="luas_panen" required>
</div>
<div class="mb-3">
    <label for="hasilPanen" class="form-label">Penguasaan hasil panen</label>
    <input type="text" class="form-control" id="hasilPanen-{{ $Sertifikasi->id }}" name="hasil_panen" required>
</div>
<div class="mb-3">
    <label for="campuran" class="form-label">Tercampurnya benih dengan varietas/ tanaman lain/areal non</label>
    <select class="form-control" id="campuran-{{ $Sertifikasi->id }}" name="campuran">
        <option value="Ada">Ada</option>
        <option value="Tidak Ada">Tidak Ada</option>
    </select>
</div>

<div class="mb-3">
    <label for="kesimpulan" class="form-label">Kesimpulan</label>
    <select class="form-control" id="kesimpulan-{{ $Sertifikasi->id }}" name="kesimpulan">
        <option value="Tidak">Tidak Lulus</option>
        <option value="Lulus">Lulus</option>
    </select>
</div>
<div class="form-group mb-4" id="form-container-Panen-{{ $Sertifikasi->id }}">
    <label class="mb-3">Peralatan Panan</label>
    <div class="d-flex">
        <input type="number" name="no[]" placeholder="no" class="form-control mx-2" style="width: 200px;"
            value="1">
        <input type="text" placeholder="Jenis" name="jenis[]" class="form-control mx-2">
        <input type="number" placeholder="jumlah" name="jumlah[]" class="form-control mx-2" value="0">
        <input type="text" placeholder="pemeriksaan" name="pemeriksaan[]" class="form-control mx-2" value="bersih">
        <input type="text" placeholder="keterangan" name="keterangan[]" class="form-control mx-2" value="-">
        <button type="button" class="btn btn-sm btn-primary add-button-Panen-{{ $Sertifikasi->id }}"><i
                class="bx bx-plus"></i></button>
    </div>
</div>
<div class="mb-3">
    <label for="catatan" class="form-label">Catatan</label>
    <textarea class="form-control" id="catatan-{{ $Sertifikasi->id }}" name="catatan"></textarea>
</div>
<button type="button" id="saveFasePanen-{{ $Sertifikasi->id }}" class="btn btn-primary">Simpan Data</button>
<script>
    $(document).ready(function() {
        //tambah form
        const formContainerPanen = document.getElementById('form-container-Panen-{{ $Sertifikasi->id }}');
        let countPanen = 2;

        function addFormPanen() {
            const formGroup = document.createElement('div');
            formGroup.classList.add('form-group', 'd-flex', 'my-2');
            formGroup.innerHTML =
                `
                    <input type="number" name="no[]" placeholder="no" class="form-control mx-2" style="width: 200px;" value="` +
                countPanen + `">
                <input type="text" placeholder="Jenis" name="jenis[]" class="form-control mx-2">
                <input type="number" placeholder="jumlah" name="jumlah[]" class="form-control mx-2" value="0">
        <input type="text" placeholder="pemeriksaan" name="pemeriksaan[]" class="form-control mx-2" value="bersih">
        <input type="text" placeholder="keterangan" name="keterangan[]" class="form-control mx-2" value="-">
                    <button type="button" class="btn btn-danger btn-sm remove-button-Panen"><i class="bx bx-trash"></i></button>
                    `;
            formContainerPanen.appendChild(formGroup);

            const removeButtonPanen = formGroup.querySelector('.remove-button-Panen');
            removeButtonPanen.addEventListener('click', () => removeFormPanen(formGroup));

            countPanen++; // Increment count after adding form

            resetNumbers(); // Reset numbers after adding form
        }

        function removeFormPanen(formGroup) {
            formGroup.remove();

            resetNumbers(); // Reset numbers after removing form
        }

        function resetNumbers() {
            const formGroups = formContainerPanen.querySelectorAll('.form-group');
            formGroups.forEach((formGroup, index) => {
                const numberInput = formGroup.querySelector('input[name="no[]"]');
                numberInput.value = index + 2; // Set correct number sequence
            });
        }

        const addButtonPanen = document.querySelector('.add-button-Panen-{{ $Sertifikasi->id }}');
        addButtonPanen.addEventListener('click', addFormPanen);

        //simpan form
        $('#saveFasePanen-{{ $Sertifikasi->id }}').click(function() {
            var formData = $('#formpemeriksaan_alat_panen-{{ $Sertifikasi->id }}').serialize();
            $.ajax({
                type: 'POST',
                url: '/sertifikasi/fase_panen_store',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    $('#modal-pemeriksaan_alat_panen').modal('hide');
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
