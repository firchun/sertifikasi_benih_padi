@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="jumbroton text-center">
        <img src="{{ asset('img/logo2.png') }}" style="width: 10vh;" class="mb-2" alt="logo">
        <h2>Selamat datang di <br><span class="text-primary">Sistem Informasi Sertifikasi Benih Padi</span></h2>
    </div>
    <hr>
    @if (Auth::user()->role != 'Penangkar')
        <div class="row justify-content-center">
            @include('admin.dashboard_component.card1', [
                'count' => $penangkars,
                'title' => 'Penangkar',
                'subtitle' => 'Total Penangkar',
                'color' => 'primary',
                'icon' => 'user',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $varietas,
                'title' => 'varietas Benih',
                'subtitle' => 'Total Varietas',
                'color' => 'success',
                'icon' => 'tree',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $Desa,
                'title' => 'Desa',
                'subtitle' => 'Total Desa',
                'color' => 'info',
                'icon' => 'city',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $Kecamatan,
                'title' => 'Kecamatan',
                'subtitle' => 'Total Kecamatan',
                'color' => 'info',
                'icon' => 'city',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $Sertifikasi,
                'title' => 'Sertifikasi',
                'subtitle' => 'Total Data Sertfikasi',
                'color' => 'warning',
                'icon' => 'folder',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $terSertifikasi,
                'title' => 'ter-sertifikasi',
                'subtitle' => 'Total Lulus Sertifikasi',
                'color' => 'success',
                'icon' => 'folder',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $Testimoni,
                'title' => 'Testimoni',
                'subtitle' => 'Total Testimoni',
                'color' => 'primary',
                'icon' => 'message',
            ])
        </div>
    @elseif(Auth::user()->role == 'Penangkar')
        @include('admin.dashboard_component.penangkar')
    @endif
@endsection
