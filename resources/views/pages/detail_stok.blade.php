@extends('layouts.app')
@section('content')
    <section class="page-header bg-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center">
                    <h2 class="mb-3 text-capitalize">{{ $title ?? 'Lokasi Penangkar' }}</h2>
                    <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                        <li class="list-inline-item"><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="list-inline-item">/ &nbsp; <a href="{{ url('/maps') }}">{{ $title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
    </section>
@endsection
