<div class="text-center">
    <button class="btn btn-secondary btn-lg create-new btn-primary" type="button" data-bs-toggle="modal"
        data-bs-target="#create">
        <span>
            <i class="bx bx-plus me-sm-1"> </i>
            <span class="d-none d-sm-inline-block">Ajukan Penangkaran</span>
        </span>
    </button>
</div>
{{-- modal --}}
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Formulir pendaftaran penangkar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPenangkar" method="POST" enctype="multipart/form-data"
                action="{{ route('penangkars.store') }}">
                @csrf
                <div class="modal-body">
                    <!-- Form for Create and Edit -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                            <div class="mb-3">
                                <label for="formNamaPenangkar" class="form-label">Nama Penangkaran</label>
                                <input type="text" class="form-control" id="formNamaPenangkar" name="nama"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="formPhone" class="form-label">Nomor HP/WA</label>
                                <input type="text" class="form-control" id="formPhone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="formJenis" class="form-label">Jenis Penangkaran</label>
                                <select class="form-select" id="formJenis" name="jenis">
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="Kelompok">Kelompok</option>
                                </select>
                            </div>
                            <div class="mb-3" id="jumlahAnggota" style="display: none;">
                                <label for="formNamaJumlahAnggota" class="form-label">Jumlah Anggota Kelompok
                                    Penangkaran</label>
                                <input type="number" class="form-control" value="0" id="formNamaJumlahAnggota"
                                    name="jumlah_anggota">
                            </div>
                            <div class="mb-3">
                                <label for="formAlamat" class="form-label">Alamat Penangkaran</label>
                                <input type="text" class="form-control" id="formAlamat" name="alamat" value="-"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="formLuasLahan" class="form-label">Luas Lahan Penangkaran</label>
                                <input type="number" class="form-control" id="formLuasLahan" name="luas_lahan"
                                    required>
                            </div>
                            <div class="form-group mt-4" id="form-container" style="display: none;">
                                <label class="mb-3">Anggota Penangkaran</label>
                                <div class="d-flex">
                                    <input type="text" name="nama_anggota[]" placeholder="Nama"
                                        class="form-control mx-2" style="width: 200px;">
                                    <input type="number" placeholder="luas" name="luas_lahan_anggota[]"
                                        class="form-control mx-2">
                                    <button type="button" class="btn btn-sm btn-primary add-button"><i
                                            class="bx bx-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-6">
                            <small class="text-danger">Geser pin untuk memberikan menyesuikan koordinat</small><br>
                            <div id="map-create" style="height: 100%;"></div>
                            <input type="hidden" name="latitude" id="latitude-create" required>
                            <input type="hidden" name="longitude" id="longitude-create" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="createDesaBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formContainer = document.getElementById('form-container');

            function addForm() {
                const formGroup = document.createElement('div');
                formGroup.classList.add('form-group', 'd-flex', 'my-2');
                formGroup.innerHTML = `
                <input type="text" name="nama_anggota[]" placeholder="Nama"
                                        class="form-control mx-2" style="width: 200px;">
                                    <input type="number" placeholder="luas" name="luas_lahan_anggota[]" class="form-control mx-2">
            <button type="button" class="btn btn-danger btn-sm remove-button"><i class="bx bx-trash"></i></button>
        `;
                formContainer.appendChild(formGroup);

                const removeButton = formGroup.querySelector('.remove-button');
                removeButton.addEventListener('click', () => removeForm(formGroup));
            }

            function removeForm(formGroup) {
                formGroup.remove();
            }

            const addButtons = document.querySelectorAll('.add-button');
            addButtons.forEach(button => {
                button.addEventListener('click', addForm);
            });
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?&key={{ env('GMAP_API_KEY') }}&callback=myMap"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const formJenis = document.getElementById('formJenis');
            const jumlahAnggota = document.getElementById('jumlahAnggota');
            const addAnggota = document.getElementById('form-container');

            formJenis.addEventListener('change', function() {
                if (formJenis.value === 'Kelompok') {
                    jumlahAnggota.style.display = 'block';
                    addAnggota.style.display = 'block';
                } else {
                    jumlahAnggota.style.display = 'none';
                    addAnggota.style.display = 'none';
                }
            });
        });
    </script>
    {{-- maps --}}
    <script>
        var mapCreate;
        var markerCreate;

        function initMapCreate() {
            mapCreate = new google.maps.Map(document.getElementById('map-create'), {
                center: {
                    lat: -8.4558282,
                    lng: 140.300181
                },
                zoom: 12
            });

            markerCreate = new google.maps.Marker({
                map: mapCreate,
                draggable: true,
                position: {
                    lat: -8.4558282,
                    lng: 140.300181
                }
            });

            google.maps.event.addListener(markerCreate, 'dragend', function() {
                var latLng = markerCreate.getPosition();
                document.getElementById('latitude-create').value = latLng.lat();
                document.getElementById('longitude-create').value = latLng.lng();
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initMapCreate();
        });
    </script>
@endpush
