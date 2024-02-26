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

        <ul class="payment_info_tab nav nav-pills justify-content-center mb-4" id="pills-tab" role="tablist">
            <li class="nav-item m-2" role="presentation"> <a class=" btn btn-outline-success effect-none  active"
                    id="maps-tab" data-bs-toggle="pill" href="#maps" role="tab" aria-controls="maps"
                    aria-selected="true">Lokasi
                    Penangkar</a>
            </li>
            <li class="nav-item m-2" role="presentation"> <a class=" btn btn-outline-success effect-none "
                    id="penangkar-tab" data-bs-toggle="pill" href="#penangkar" role="tab" aria-controls="penangkar"
                    aria-selected="false">Daftar Penangkar</a>
            </li>

        </ul>
        <div class="container">

            <div class="rounded shadow bg-white p-5 tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="maps" role="tabpanel" aria-labelledby="maps-tab">
                    <div id="gmap" style="height: 600px; width:100%;"></div>
                </div>
                <div class="tab-pane fade" id="penangkar" role="tabpanel" aria-labelledby="penangkar-tab">
                    <div class="container">
                        <h3>Daftar Penangkar</h3>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?&key={{ env('GMAP_API_KEY') }}&callback=myMap"></script>
    <script>
        function initialize() {
            var center = new google.maps.LatLng(-8.3983748, 140.4270463);
            var mapOptions = {
                zoom: 11.3,
                center: center,
                zoomControl: true,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };
            var map = new google.maps.Map(document.getElementById('gmap'), mapOptions);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endpush
