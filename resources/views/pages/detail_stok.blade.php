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
        <div class="container">

            <div class="row justify-content-center" id="additional_Info">
                <div id="loading" style="display: none; text-align: center;">
                    <h4>Harap Tunggu....</h4>
                </div>
                <div id="dataKosong" style="display: none; text-align: center;">
                    <h4>Data tidak ditemukan!!</h4>
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
                    url: '{{ url('/stoks/detail_stok', $varietas->id) }}',
                    method: 'GET',
                    success: function(response) {
                        $('#loading').hide();
                        $('#additional_Info').empty();

                        if (response.length > 0) {
                            $.each(response, function(index, item) {
                                var accordionId = item.id_penangkar;
                                var newTitle = item.penangkar
                                    .nama;
                                var harga = item.kelas_benih
                                    .price;

                                var accordionContent = `
                                    <div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
                                        <div class="rounded shadow py-5 px-4">
                                            <div class="icon"> <i class="fas fa-leaf"></i> </div>
                                            <h3 class="mb-3">Penangkaran : ${newTitle}</h3>
                                            
                                            <h1 class="mb-3 text-danger">Rp ${formatNumberWithDot(harga)}</h1>
                                            <strong class="p-1 mb-3 bg-${item.stok > 0 ? 'warning' : 'danger'} text-${item.stok > 0 ? 'black' : 'white'}" style="border-radius: 10px;">
                                                ${item.stok > 0 ? 'Tersedia ' + item.stok + ' Kg' : 'Stok Kosong'}
                                            </strong>
                                                <p class="mb-3">
                                                    <strong class="text-success">Alamat Penangkar</strong><br>
                                                <span>${item.penangkar.alamat}</span><br>
                                                </p>
                                                <a class="btn btn-sm btn-outline-primary" target="_blank" href="https://maps.google.com/?saddr=My+Location&daddr=${item.penangkar.latitude},${item.penangkar.longitude}">Lokasi <i class="fa fa-arrow-right ms-1"></i></a>
                                        </div>
                                    </div>
                                `;
                                $('#additional_Info').append(accordionContent);
                            });
                        } else {
                            $('#additional_Info').html(
                                '<h5 style="text-align: center;" class="text-muted">Maaf, data tidak ditemukan.</h5>'
                            );
                            $('#pagination').html('');
                        }
                    },
                    error: function() {
                        console.log('Gagal mengambil data');
                    }
                });
            }
            loadData();

            function formatNumberWithDot(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        })
    </script>
@endpush
