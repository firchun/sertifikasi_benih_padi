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
                    <div id="loadingIndicator" class="d-none text-center" style="margin-top:50px; margin-bottom:50px;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2">Loading...</span>
                    </div>
                </div>
                @include('admin.dashboard_component.modal_stok')
                @foreach (App\Models\Sertifikasi::where('id_user', Auth::user()->id)->get() as $Sertifikasi)
                    @php
                        $penangkar = App\Models\Penangkar::where('id_user', $Sertifikasi->id_user)->first();
                        $pendahuluan = App\Models\SertifikasiPendahuluan::where(
                            'id_sertifikasi',
                            $Sertifikasi->id,
                        )->first();
                        $vegetatif = App\Models\SertifikasiVegetatif::where(
                            'id_sertifikasi',
                            $Sertifikasi->id,
                        )->first();
                        $masak = App\Models\SertifikasiMasak::where('id_sertifikasi', $Sertifikasi->id)->first();
                        $berbunga = App\Models\SertifikasiBerbunga::where('id_sertifikasi', $Sertifikasi->id)->first();
                        $panen = App\Models\SertifikasiPanen::where('id_sertifikasi', $Sertifikasi->id)->first();
                        $uji_lab = App\Models\SertifikasiLab::where('id_sertifikasi', $Sertifikasi->id)->first();
                    @endphp
                    @include('admin.sertifikasi.components.modal')
                @endforeach
                @push('js')
                    <script>
                        $(document).ready(function() {
                            window.editSertifikasi = function(id) {
                                $('#sertifikasiModal' + id).modal('show');
                            };

                            function dataSertifikasi() {
                                $('#loadingIndicator').removeClass('d-none');
                                $.ajax({
                                    url: '{{ route('sertifikasi.get') }}',
                                    type: 'GET',
                                    success: function(response) {
                                        var sertifikasiData = response.data;
                                        var sertifikasiHtml = '';
                                        sertifikasiData.forEach(function(item) {
                                            var stok = '';
                                            var warna = '';

                                            if (item.uji_lab.length !== 0) {
                                                stok = `
                                                <p class="mt-3">Stok benih</p>
                                                <button type="button" class="btn btn-sm btn-warning mb-3" onclick="updateStok(${item.id})">Update Stok</button>
                                                    <ul class="list-group"> 
                                                        <li class="list-group-item d-flex align-items-center">
                                                            <i class="bx bxs-component me-2"></i>
                                                            Stok : ${item.jumlahStok} Kg 
                                                        </li>
                                                    </ul>
                                                `;
                                                window.updateStok = function(id) {
                                                    $('#update-stok').modal('show');
                                                    $('#idVarieatas').val(item.id_varietas);
                                                    $('#idKelasBenih').val(item.id_kelas_benih);
                                                    $('#idSertifikasi').val(item.id);
                                                    $('#idPenangkar').val(item.penangkar.id);
                                                    console.log(item);
                                                };
                                            }
                                            if (item.status == 'Permohonan ditolak' ||
                                                item.status == 'Tidak memenuhi syarat areal sertifikasi' ||
                                                item.status == 'Gagal Fase Vegetatif' ||
                                                item.status == 'Gagal Fase Berbunga' ||
                                                item.status == 'Gagal Fase Masak' ||
                                                item.status == 'Gagal Pemeriksaan Peralatan Panen' ||
                                                item.status == 'Gagal uji laboratorium'
                                            ) {
                                                warna = 'danger';
                                            } else {
                                                warna = 'primary';
                                            }
                                            sertifikasiHtml += `
                                                <div class="col-lg-6 mb-3">
                                                    <div class="card border border-${warna}">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <span>Data Sertifikasi <span class="badge bg-success">Benih Padi</span></span>
                                                            <div class="btn-group float-end">
                                                                <button type="button" class="btn  btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="bx bx-menu"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><button type="button" class="dropdown-item" onclick="editSertifikasi(${item.id})">Detail Sertifikasi</button></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);">Edit data</a></li>
                                                               
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
                                                            ${stok}
                                                        </div>
                                                        <div class="card-footer bg-${warna} text-white">
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
                            $('#saveStok').click(function() {
                                var formData = $('#updateStok').serialize();
                                $.ajax({
                                    url: '{{ route('stoks.store') }}',
                                    type: 'POST',
                                    data: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(response) {
                                        alert(response.message);
                                        $('#update-stok').modal('hide');
                                        dataSertifikasi();

                                    },
                                    error: function(xhr, status, error) {
                                        alert('Terjadi kesalahan: ' + xhr.responseText);
                                    }
                                });
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
                                <td><input type="text" value="{{ $penangkar->jumlah_anggota }}" class="form-control">
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="fw-bold">Luas Lahan Penangkaran</td>
                            <td>:</td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" value="{{ $penangkar->luas_lahan }}" class="form-control">
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
        </div>
    </div>

</div>
