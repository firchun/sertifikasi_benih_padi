<div class="btn-group">
    <button class="btn btn-sm btn-primary" onclick="editSertifikasi({{ $Sertifikasi->id }})">Lihat Data</button>
    @if ($Sertifikasi->status == 'Proses Permohonan' && Auth::user()->role == 'BPSB')
        <button class="btn btn-sm btn-success" onclick="terimaPermohonan({{ $Sertifikasi->id }})">Terima
        </button>
        <button class="btn btn-sm btn-danger" onclick="tolakPermohonan({{ $Sertifikasi->id }})">Tolak
        </button>
    @endif
</div>
@include('admin.sertifikasi.components.modal')
