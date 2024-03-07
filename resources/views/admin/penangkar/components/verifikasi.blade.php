<div class="btn-group text-center">
    @if ($Penangkar->is_verified == 0)
        @if (Auth::user()->role == 'Dinas')
            <button class="btn btn-sm btn-success" onclick="verifikasiPenangkar({{ $Penangkar->id }})">Verifikasi</button>
        @else
            <span class="text-danger">Pending</span>
        @endif
    @else
        <span class="badge badge-center rounded-pill bg-label-primary"><i class="bx bx-check"></i></span>
    @endif
</div>
