@extends('layouts.backend.admin')

@section('content')
    <div class="jumbroton text-center">
        <img src="{{ asset('img/logo2.png') }}" style="width: 10vh;" class="mb-2" alt="logo">
        <h2>Selamat datang di <br><span class="text-primary">Sistem Informasi Sertifikasi Benih Padi</span></h2>
    </div>
    <hr>
    @if (Auth::user()->role != 'Penangkar' && Auth::user()->role != 'Gapoktan')
        <div class="row">
            @include('admin.dashboard_component.card1', [
                'count' => $users,
                'title' => 'Pengguna',
                'subtitle' => 'Total pengguna',
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
        </div>
    @endif
@endsection
