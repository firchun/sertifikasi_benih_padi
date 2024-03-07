@php
    $penangkar = App\Models\Penangkar::where('id_user', Auth::user()->id)->get();
    $penangkar_verified = App\Models\Penangkar::where('id_user', Auth::user()->id)
        ->where('is_verified', 1)
        ->get();
    $sertifikasi = App\Models\Sertifikasi::where('id_user', Auth::user()->id)->get();
@endphp
@if ($penangkar->isEmpty())
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
                                    <input type="text" class="form-control" id="formAlamat" name="alamat"
                                        value="-" required>
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
@else
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                @if ($sertifikasi->isEmpty())
                    <div class="text-center">
                        <div class="border border-primary bg-white"
                            style="margin-top:20px; margin-bottom:20px; padding:30px; border-radius:20px;">
                            @if ($penangkar_verified->isEmpty())
                                <p class="text-muted">Pegajuan anda sebagai penangkar belum disetujui oleh Dinas,
                                    Silahkan menghubungi pihak terkait..</p>
                            @else
                                <p class="text-muted">Anda belum melakukan sertifikasi, silahkan klik tombol dibawah
                                    untuk
                                    mengajuakn data sertifikasi..</p>
                            @endif
                            <a href="{{ route('sertifikasi.pengajuan') }}"
                                class="btn btn-lg btn-primary {{ $penangkar_verified->isEmpty() ? 'disabled' : '' }}"><span
                                    class="bx bx-file"></span> Ajukan Sertifikasi</a>
                        </div>
                    </div>
                @else
                    <div class="d-flex mb-4">
                        <a href="{{ route('sertifikasi.pengajuan') }}" class="btn btn-lg btn-primary"><span
                                class="bx bx-file"></span> Ajukan Sertifikasi Baru</a>
                        <button id="refreshDataBtn" class="btn btn-secondary mx-3"> <i class="bx bx-sync me-sm-1">
                            </i></button>
                    </div>
                    <hr>
                    <div id="sertifikasiContainer" class="row">
                        <div id="loadingIndicator" class="d-none text-center"
                            style="margin-top:50px; margin-bottom:50px;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span class="ms-2">Loading...</span>
                        </div>
                    </div>
                    @push('js')
                        <script>
                            $(document).ready(function() {
                                function dataSertifikasi() {
                                    $('#loadingIndicator').removeClass('d-none');
                                    $.ajax({
                                        url: '{{ route('sertifikasi.get') }}',
                                        type: 'GET',
                                        success: function(response) {
                                            var sertifikasiData = response.data;
                                            var sertifikasiHtml = '';
                                            sertifikasiData.forEach(function(item) {
                                                sertifikasiHtml += `
                                            <div class="col-md-6 mb-3">
                                                <div class="card border border-${item.status == 'Permohonan ditolak' ? 'danger' : 'primary'}">
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        <span>Data Sertifikasi <span class="badge bg-success">Benih Padi</span></span>
                                                        <div class="btn-group float-end">
                                                            <button type="button" class="btn  btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bx bx-menu"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0);">Detail Sertifikasi</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0);">Edit data</a></li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item text-danger" href="javascript:void(0);">Batalkan Pengajuan</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul class="list-group mb-3">
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <i class="bx bx-user me-2"></i>
                                                                ${item.user ? item.user.name : 'Nama Tidak Tersedia'}
                                                            </li>
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <i class="bx bx-current-location me-2"></i>
                                                                ${item.desa.name}, ${item.kecamatan.name} - Merauke
                                                            </li>
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <i class="bx bx-droplet me-2"></i>
                                                                Varietas ${item.varietas.name}
                                                            </li>
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <i class="bx bx-calendar me-2"></i>
                                                                Tanam : ${item.tanggal_tanam}
                                                            </li>
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <i class="bx bx-calendar me-2"></i>
                                                                Sebar : ${item.tanggal_sebar}
                                                            </li>
                                                        </ul>
                                                        <p>Asal Benih</p>
                                                        <ul class="list-group"> 
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <i class="bx bx-user me-2"></i>
                                                                Produsen : ${item.produsen_asal}
                                                            </li>
                                                            <li class="list-group-item d-flex align-items-center">
                                                                <i class="bx bx-droplet me-2"></i>
                                                                Asal Benih : ${item.benih_asal}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="card-footer bg-${item.status == 'Permohonan ditolak' ? 'danger' : 'primary'} text-white">
                                                        <strong class="text-center">Status : ${item.status}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        `;
                                            });
                                            $('#sertifikasiContainer').html(sertifikasiHtml);
                                        },
                                        error: function(xhr, status, error) {
                                            console.error(xhr.responseText);
                                        },
                                        complete: function() {
                                            $('#loadingIndicator').addClass('d-none');
                                        }
                                    });
                                }
                                $('#refreshDataBtn').click(function() {
                                    dataSertifikasi();
                                });
                                dataSertifikasi();
                            });
                        </script>
                    @endpush
                @endif
            </div>
            <div class="col-lg-4 col-md-6">
                @php
                    $penangkar = App\Models\Penangkar::where('id_user', Auth::user()->id)->first();
                    $anggota = App\Models\PenangkarAnggota::where('id_penangkar', $penangkar->id)->get();
                @endphp
                <div class="card mb-3">
                    <div class="card-header">
                        Data Penangkaran
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <tr>
                                <td class="fw-bold">Nama Penangkaran</td>
                                <td>:</td>
                                <td><input type="text" value="{{ $penangkar->nama }}" class="form-control"> </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Alamat Penangkaran</td>
                                <td>:</td>
                                <td><input type="text" value="{{ $penangkar->alamat }}" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">jenis Penangkaran</td>
                                <td>:</td>
                                <td>{{ $penangkar->jenis }}</td>
                            </tr>
                            @if ($penangkar->jenis == 'Kelompok')
                                <tr>
                                    <td class="fw-bold">Jumlah Anggota</td>
                                    <td>:</td>
                                    <td><input type="text" value="{{ $penangkar->jumlah_anggota }}"
                                            class="form-control"></td>
                                </tr>
                            @endif
                            <tr>
                                <td class="fw-bold">Luas Lahan Penangkaran</td>
                                <td>:</td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" value="{{ $penangkar->luas_lahan }}"
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text">/ha</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Koordinat</td>
                                <td>:</td>
                                <td>{{ $penangkar->latitude }} , {{ $penangkar->longitude }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan
                            Perubahan</button>

                    </div>
                </div>
                @if ($anggota != null)
                    <div class="card">
                        <div class="card-header">Anggota Penangkaran</div>
                        <div class="card-body">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Luas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota as $item)
                                        <tr>
                                            <td>{{ $item->nama_anggota }}</td>
                                            <td>{{ $item->luas_lahan }} /ha</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endif
