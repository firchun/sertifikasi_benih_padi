@php
    $tahapan = [
        'permohonan' => 'Permohonan',
        'fase_pendahuluan' => 'Fase Pendahuluan',
        'fase_vegetatif' => 'Fase Vegetatif',
        'fase_berbunga' => 'Fase Berbunga',
        'fase_masak' => 'Fase Masak',
        'pemeriksaan_alat_panen' => 'Pemeriksaan Alat Panen',
    ];
@endphp

<!-- Modal for Create and Edit -->
<div class="modal fade" id="sertifikasiModal{{ $Sertifikasi->id }}" tabindex="-1" aria-labelledby="customersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Detail Sertifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        @foreach ($tahapan as $key => $value)
                            <li class="nav-item">
                                <button type="button" class="nav-link {{ $key == 'permohonan' ? 'active' : '' }}"
                                    role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-justified-{{ $key }}"
                                    aria-controls="navs-pills-justified-{{ $key }}" aria-selected="true">
                                    <i class="tf-icons bx bx-message-square"></i> {{ $value }}
                                    {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span> --}}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($tahapan as $key => $value)
                            <div class="tab-pane fade {{ $key == 'permohonan' ? 'active show' : '' }} r"
                                id="navs-pills-justified-{{ $key }}" role="tabpanel">
                                @php
                                    $permohonan = App\Models\Sertifikasi::find($Sertifikasi->id)->first();
                                    $fase_pendahuluan = App\Models\SertifikasiPendahuluan::where(
                                        'id_sertifikasi',
                                        $Sertifikasi->id,
                                    )->first();
                                    $fase_vegetatif = App\Models\SertifikasiVegetatif::where(
                                        'id_sertifikasi',
                                        $Sertifikasi->id,
                                    )->first();
                                    $fase_berbunga = App\Models\SertifikasiBerbunga::where(
                                        'id_sertifikasi',
                                        $Sertifikasi->id,
                                    )->first();
                                    $fase_masak = App\Models\SertifikasiMasak::where(
                                        'id_sertifikasi',
                                        $Sertifikasi->id,
                                    )->first();
                                    $pemeriksaan_alat_panen = App\Models\SertifikasiPanen::where(
                                        'id_sertifikasi',
                                        $Sertifikasi->id,
                                    )->first();
                                @endphp
                                @if ($key == 'permohonan')
                                    @if ($permohonan)
                                        @include('admin.sertifikasi.data.' . $key)
                                    @else
                                        <div class="text-center">
                                            <p> {{ $value }} belum diupdate..</p>
                                            <button class="btn btn-secondary btn-primary" type="button"
                                                onclick="openFase('{{ $key }}')">
                                                <span>
                                                    <i class="bx bx-plus me-sm-1"> </i>
                                                    <span class="d-none d-sm-inline-block"> Isi data
                                                        {{ $value }}</span>
                                                </span>
                                            </button>
                                        </div>
                                    @endif
                                @elseif($key == 'fase_pendahuluan')
                                    @if ($fase_pendahuluan)
                                        @include('admin.sertifikasi.data.' . $key)
                                    @else
                                        <div class="text-center">
                                            <p> {{ $value }} belum diupdate..</p>
                                            @if (Auth::user()->role == 'BPSB' && $permohonan->status == 'Permohonan diterima')
                                                <button class="btn btn-secondary btn-primary" type="button"
                                                    onclick="openFase('{{ $key }}')">
                                                    <span>
                                                        <i class="bx bx-plus me-sm-1"> </i>
                                                        <span class="d-none d-sm-inline-block"> Isi data
                                                            {{ $value }}</span>
                                                    </span>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                @elseif($key == 'fase_vegetatif')
                                    @if ($fase_vegetatif)
                                        @include('admin.sertifikasi.data.' . $key)
                                    @else
                                        <div class="text-center">
                                            <p> {{ $value }} belum diupdate..</p>
                                            @if (Auth::user()->role == 'BPSB' && $fase_pendahuluan)
                                                @if ($fase_pendahuluan->kesimpulan == 'Memenuhi')
                                                    <button class="btn btn-secondary btn-primary" type="button"
                                                        onclick="openFase('{{ $key }}')">
                                                        <span>
                                                            <i class="bx bx-plus me-sm-1"> </i>
                                                            <span class="d-none d-sm-inline-block"> Isi data
                                                                {{ $value }}</span>
                                                        </span>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                @elseif($key == 'fase_berbunga')
                                    @if ($fase_berbunga)
                                        @include('admin.sertifikasi.data.' . $key)
                                    @else
                                        <div class="text-center">
                                            <p> {{ $value }} belum diupdate..</p>
                                            @if (Auth::user()->role == 'BPSB' && $fase_vegetatif)
                                                @if ($fase_vegetatif->kesimpulan == 'Lulus')
                                                    <button class="btn btn-secondary btn-primary" type="button"
                                                        onclick="openFase('{{ $key }}')">
                                                        <span>
                                                            <i class="bx bx-plus me-sm-1"> </i>
                                                            <span class="d-none d-sm-inline-block"> Isi data
                                                                {{ $value }}</span>
                                                        </span>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                @elseif($key == 'fase_masak')
                                    @if ($fase_masak)
                                        @include('admin.sertifikasi.data.' . $key)
                                    @else
                                        <div class="text-center">
                                            <p> {{ $value }} belum diupdate..</p>
                                            @if (Auth::user()->role == 'BPSB' && $fase_berbunga)
                                                @if ($fase_berbunga->kesimpulan == 'Lulus')
                                                    <button class="btn btn-secondary btn-primary" type="button"
                                                        onclick="openFase('{{ $key }}')">
                                                        <span>
                                                            <i class="bx bx-plus me-sm-1"> </i>
                                                            <span class="d-none d-sm-inline-block"> Isi data
                                                                {{ $value }}</span>
                                                        </span>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                @elseif($key == 'pemeriksaan_alat_panen')
                                    @if ($pemeriksaan_alat_panen)
                                        @include('admin.sertifikasi.data.' . $key)
                                    @else
                                        <div class="text-center">
                                            <p> {{ $value }} belum diupdate..</p>
                                            @if (Auth::user()->role == 'BPSB' && $fase_masak)
                                                @if ($fase_masak->kesimpulan == 'Lulus')
                                                    <button class="btn btn-secondary btn-primary" type="button"
                                                        onclick="openFase('{{ $key }}')">
                                                        <span>
                                                            <i class="bx bx-plus me-sm-1"> </i>
                                                            <span class="d-none d-sm-inline-block"> Isi data
                                                                {{ $value }}</span>
                                                        </span>
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@foreach ($tahapan as $key => $value)
    <div class="modal fade" id="modal-{{ $key }}" tabindex="-1" aria-labelledby="customersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Form {{ $value }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form{{ $key }}">
                        @include('admin.sertifikasi.formulir.' . $key)
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- //uji lab --}}
<div class="modal fade" id="modal-uji-lab-{{ $Sertifikasi->id }}" tabindex="-1" aria-labelledby="customersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel"> Uji Laboratorium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($panen)
                    @if ($uji_lab)
                        @if ($uji_lab->kesimpulan == 'Lulus')
                            <div class="mb-3">
                                <button class="btn btn-primary" onclick="cetakSertifikat({{ $Sertifikasi->id }})"><i
                                        class="bx bx-file"></i> Cetak Sertifikat</button>
                                <button class="btn btn-warning" onclick="cetakLabel({{ $Sertifikasi->id }})"><i
                                        class="bx bx-purchase-tag"></i> Cetak
                                    Label</button>
                            </div>
                            @include('admin.sertifikasi.components.script_cetak')
                        @endif
                    @endif
                @endif
                <form id="form-uji-laboratorium">
                    @if ($panen)
                        @if ($uji_lab)
                            @include('admin.sertifikasi.data.uji_lab')
                        @else
                            @include('admin.sertifikasi.formulir.uji_lab')
                        @endif
                    @else
                        <div class="text-center">
                            Menunggu proses pemeriksaan lapangan...
                        </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
