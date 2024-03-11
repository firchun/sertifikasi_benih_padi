<div class="btn-group">
    <button class="btn btn-sm btn-primary" onclick="editSertifikasi({{ $Sertifikasi->id }})">Data Lapangan</button>
    <button class="btn btn-sm btn-success" onclick="editLaboratorium({{ $Sertifikasi->id }})">Data Lab</button>
    @if ($Sertifikasi->status == 'Proses Permohonan' && Auth::user()->role == 'BPSB')
        <button class="btn btn-sm btn-success" onclick="terimaPermohonan({{ $Sertifikasi->id }})">Terima
        </button>
        <button class="btn btn-sm btn-danger" onclick="tolakPermohonan({{ $Sertifikasi->id }})">Tolak
        </button>
    @endif
</div>
@include('admin.sertifikasi.components.modal')
