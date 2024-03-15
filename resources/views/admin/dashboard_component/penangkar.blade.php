@php
    $penangkar = App\Models\Penangkar::where('id_user', Auth::user()->id)->get();
    $penangkar_verified = App\Models\Penangkar::where('id_user', Auth::user()->id)
        ->where('is_verified', 1)
        ->get();
    $sertifikasi = App\Models\Sertifikasi::where('id_user', Auth::user()->id)->get();
@endphp
@if ($penangkar->isEmpty())
    @include('admin.dashboard_component.penangkar_empty')
@else
    @include('admin.dashboard_component.penangkar_notEmpty')
@endif
