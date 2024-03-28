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
                <td>{{ $penangkar->nama }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Nomor HP/WA</td>
                <td>:</td>
                <td>{{ $penangkar->phone }}</td>
            </tr>
            <tr>
                <td class="fw-bold">Alamat Penangkaran</td>
                <td>:</td>
                <td>{{ $penangkar->alamat }}</td>
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
                    <td>{{ $penangkar->jumlah_anggota }}
                    </td>
                </tr>
            @endif
            <tr>
                <td class="fw-bold">Luas Lahan Penangkaran</td>
                <td>:</td>
                <td>{{ $penangkar->luas_lahan }} Ha
                </td>
            </tr>
            <tr>
                <td class="fw-bold">Koordinat</td>
                <td>:</td>
                <td><a target="__blank"
                        href="https://www.google.com/maps/search/?api=1&query={{ $penangkar->latitude }},{{ $penangkar->longitude }}">{{ $penangkar->latitude }}
                        , {{ $penangkar->longitude }}</a></td>
            </tr>
        </table>
    </div>
    <div class="card-footer text-center">
        <button type="button" onclick="editPenangkar({{ $penangkar->id }})" class="btn btn-warning"><i
                class="bx bx-edit"></i> Rubah Data</button>
    </div>
</div>
<div class="modal fade" id="penangkarModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Penangkaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('penangkars.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Form for Create and Edit -->
                    <input type="hidden" id="formPenangkarId" name="id">
                    <input type="hidden" name="id_user" id="formPenangkarIdUser">
                    <input type="hidden" name="jenis" id="formPenangkarJenis">
                    <div class="mb-3">
                        <label for="formPenangkarNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="formPenangkarNama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="formPenangkarPhone" class="form-label">Nomor HP/WA</label>
                        <input type="text" class="form-control" id="formPenangkarPhone" name="phone" required>
                    </div>
                    <div class="mb-3" id="editJumlahAnggota" style="display: none;">
                        <label for="formPenangkarJumlahAnggota" class="form-label">Jumlah Anggota Kelompok
                            Penangkaran</label>
                        <input type="number" class="form-control" id="formPenangkarJumlahAnggota"
                            name="jumlah_anggota">
                    </div>
                    <div class="mb-3">
                        <label for="formPenangkarAlamat" class="form-label">Alamat Penangkaran</label>
                        <input type="text" class="form-control" id="formPenangkarAlamat" name="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="formPenangkarLuasLahan" class="form-label">Luas Lahan Penangkaran</label>
                        <input type="number" class="form-control" id="formPenangkarLuasLahan" name="luas_lahan"
                            required>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        {{-- <small class="text-danger">Geser pin untuk memberikan menyesuikan koordinat</small><br> --}}
                        <div id="map-edit" style="height: 100%;"></div>
                        <input type="hidden" name="latitude" id="latitude-edit" required>
                        <input type="hidden" name="longitude" id="longitude-edit" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveDesaBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAP_API_KEY') }}&callback=initMapEdit" defer></script> --}}

<script>
    window.editPenangkar = function(id) {
        $.ajax({
            type: 'GET',
            url: '/penangkars/edit/' + id,
            success: function(response) {
                if (response && response.latitude !== undefined && response.longitude !== undefined) {
                    $('#formPenangkarId').val(response.id);
                    $('#formPenangkarIdUser').val(response.id_user);
                    $('#formPenangkarNama').val(response.nama);
                    $('#formPenangkarPhone').val(response.phone);
                    $('#formPenangkarLuasLahan').val(response.luas_lahan);
                    $('#formPenangkarAlamat').val(response.alamat);
                    $('#formPenangkarJenis').val(response.jenis);
                    $('#formPenangkarJumlahAnggota').val(response.jumlah_anggota);
                    $('#latitude-edit').val(response.latitude);
                    $('#longitude-edit').val(response.longitude);
                    //anggota
                    const jumlahAnggota = document.getElementById('editJumlahAnggota');
                    if (response.jenis === 'Kelompok') {
                        jumlahAnggota.style.display = 'block';
                    } else {
                        jumlahAnggota.style.display = 'none';
                    }
                    $('#penangkarModal').modal('show');
                    // Panggil initMapEdit hanya jika respons valid
                    // initMapEdit(response);
                } else {
                    alert('Data koordinat tidak valid');
                }

            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
    };


    // function initMapEdit(response) {
    //     var mapEdit = new google.maps.Map(document.getElementById('map-edit'), {
    //         center: {
    //             lat: parseFloat(response.latitude),
    //             lng: parseFloat(response.longitude)
    //         },
    //         zoom: 12
    //     });

    //     var markerEdit = new google.maps.Marker({
    //         map: mapEdit,
    //         draggable: true,
    //         position: {
    //             lat: parseFloat(response.latitude),
    //             lng: parseFloat(response.longitude)
    //         }
    //     });

    //     google.maps.event.addListener(markerEdit, 'dragend', function() {
    //         var latLng = markerEdit.getPosition();
    //         document.getElementById('latitude-edit').value = latLng.lat();
    //         document.getElementById('longitude-edit').value = latLng.lng();
    //     });

    // }
    // initMapEdit(response);
</script>

@if ($anggota->count() != 0)
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
