<div class="btn-group">
    <button class="btn btn-sm btn-primary" onclick="editSertifikasi({{ $Sertifikasi->id }})">Data Lapangan</button>
    @if ($panen)
        <button class="btn btn-sm btn-success" onclick="editLaboratorium({{ $Sertifikasi->id }})">Data Lab</button>
    @endif
</div>
@if ($Sertifikasi->status == 'Proses Permohonan Sertifikasi' && Auth::user()->role == 'BPSB')
    <br>
    <div class="btn-group">
        <button class="btn btn-sm btn-success" onclick="terimaPermohonan({{ $Sertifikasi->id }})">Terima
        </button>
        <button class="btn btn-sm btn-danger" onclick="tolakPermohonan({{ $Sertifikasi->id }})">Tolak
        </button>
    </div>
@endif
@include('admin.sertifikasi.components.modal')
