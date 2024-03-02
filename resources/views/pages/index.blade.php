@extends('layouts.app')
@section('content')
    {{-- //carousel --}}
    <section class="section">
        <div class="container">

            <div class="post-slider rounded overflow-hidden" style="border-radius: 20px; height:50vh;">
                <img loading="lazy" decoding="async" src="{{ asset('img/benih.JPG') }}" alt="Post Thumbnail"
                    style="height:50vh; object-fit : cover;">
                <img loading="lazy" decoding="async" src="{{ asset('img/dinastphbun.jpg') }}" alt="Post Thumbnail"
                    style="height:50vh; object-fit : cover;">
                <img loading="lazy" decoding="async" src="{{ asset('img/padi.jpg') }}" alt="Post Thumbnail"
                    style="height:50vh; object-fit : cover;">
            </div>
        </div>
    </section>
    {{-- end carousel  --}}
    {{-- ACT --}}
    <section class="banner  position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="block text-center text-lg-start pe-0 pe-xl-5">
                        <h1 class="text-capitalize mb-4">Dengan benih padi bersertifikat, hasil panen lebih baik dan
                            meningkat.</h1>
                        <p class="mb-4">Dengan benih padi bersertifikat, hasil panen lebih terjamin karena telah melalui
                            proses seleksi dan pengujian ketat, meningkatkan produktivitas, kualitas panen, dan mendukung
                            keberlanjutan lingkungan serta ekonomi lokal.
                            {{-- Tingkatkan Kualitas Hasil Panen dengan Benih Padi Bersertifikat! --}}
                        </p>
                        <a type="button" class="btn btn-primary" href="{{ route('register') }}">Daftar menjadi penangkar
                            <span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span></a>
                        <a type="button" class="btn btn-outline-primary" href="{{ route('stoks') }}">Lihat Stok
                            Benih<span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5 text-center">
                        <img loading="lazy" decoding="async" src="{{ asset('img/benih-karung.png') }}" alt="banner image"
                            class="w-80">
                    </div>
                </div>
            </div>
        </div>

    </section>
    {{-- ACT --}}
    @include('pages.partials.penangkar')
    @include('pages.partials.testimoni')
@endsection
