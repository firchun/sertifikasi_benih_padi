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
                        <hr>
                        <!-- Tampilan loading -->
                        <div id="loading" style="display: none; text-align: center;">
                            <h4>Harap Tunggu....</h4>
                        </div>
                        <div class="widget widget-categories">
                            <ul class="list-unstyled widget-list" id="additional_Info">

                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#loading').show();

            function loadData() {
                $.ajax({
                    url: "{{ route('penangkars.getall') }}",
                    dataType: 'json',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#loading').hide();
                        // Membersihkan data sebelum memuat yang baru
                        $('#additional_Info').empty();
                        // Memuat data baru
                        $.each(response, function(index, item) {
                            var accordionContent = `
                           
                            <li><a href="https://maps.google.com/?saddr=My+Location&daddr=${item.latitude},${item.longitude}" target="_blank"><strong>Penangkaran :</strong> ${item.nama}</a>
                                        </li>
                            `;
                            $('#additional_Info').append(accordionContent);
                        });

                    },
                    error: function() {
                        console.log('Gagal mengambil data');
                    }
                });
            }
            loadData();
        });
    </script>
    {{-- maps --}}
    <script src="https://maps.googleapis.com/maps/api/js?&key={{ env('GMAP_API_KEY') }}&callback=myMap"></script>
    <script>
        var map;
        var markers = [];

        function initialize() {
            var center = new google.maps.LatLng(-8.3983748, 140.4270463);
            var mapOptions = {
                zoom: 11.3,
                center: center,
                zoomControl: true,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };
            map = new google.maps.Map(document.getElementById('gmap'), mapOptions);

            $.ajax({
                url: "{{ route('penangkars.getall') }}",
                dataType: 'json',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    markers = response.map(el => {
                        return {
                            "id": el['id'],
                            "nama": el['nama'],
                            "ketua": el['user']['name'],
                            "latitude": parseFloat(el['latitude']),
                            "longitude": parseFloat(el['longitude']),
                        }
                    });
                    for (i = 0; i < markers.length; i++) {
                        addMarker(markers[i]);
                    }
                }
            });
        }

        function addMarker(marker) {
            var pos = new google.maps.LatLng(marker["latitude"], marker["longitude"]);

            var content = `
                <div class="popupContent" style="width:200px;">
                    <div class="text-center justify-content-center text-black">
                        <strong>Penangkar ${marker.nama}</strong>
                        <hr>
                            <br><strong>Nama Penangkaran :</strong><br> ${marker.nama}<br>
                            <strong>Ketua Penangkaran :</strong> <br>${marker.ketua}
                        <div class="mt-4">
                        <a href="https://maps.google.com/?saddr=My+Location&daddr=${marker.latitude},${marker.longitude}" target="_blank" class="btn btn-primary btn-sm" style="padding:10px;">Rute</a>
                        </div>
                    </div>
                </div>
            `;

            var icon = {
                url: '{{ asset('img/marker.png') }}',
                scaledSize: new google.maps.Size(30, 41)
            };

            var marker1 = new google.maps.Marker({
                position: pos,
                map: map,
                icon: icon
            });

            // Marker click listener
            google.maps.event.addListener(marker1, 'click', function() {
                var infowindow = new google.maps.InfoWindow({
                    content: content
                });
                infowindow.open(map, marker1);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endpush
