@extends('layouts.app')
@section('content')
    <section class="page-header bg-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center">
                    <h2 class="mb-3 text-capitalize">{{ $title ?? 'Stok Benih' }}</h2>
                    <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                        <li class="list-inline-item"><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="list-inline-item">/ &nbsp; <a href="{{ url('/stoks') }}">{{ $title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </section>
    <section class="section">

        <div class="container">
            <div class="card mb-5 border-0 shadow shadow-lg">
                <div class="card-body">
                    <input type="text" class="form-control  bg-white border-success" style="border-radius: 20px;"
                        id="search" placeholder="Cari Varietas disini....">
                </div>
            </div>
            <div class="row justify-content-center" id="additional_Info">
                <div id="loading" style="display: none; text-align: center;">
                    <h4>Harap Tunggu....</h4>
                </div>
                <div id="dataKosong" style="display: none; text-align: center;">
                    <h4>Data tidak ditemukan!!</h4>
                </div>
            </div>
            <div id="pagination" class="mt-3">
                <!-- Placeholder untuk tautan paginasi -->
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).on('keyup', '#searchInput', function() {
            var search = $(this).val();
            loadData(1, search);
        });
        $(document).ready(function() {
            $('#search').on('input', function() {
                applyFilters();
            });

            function applyFilters() {
                var searchFilter = $('#search').val();
                $('#loading').show();
                loadData(1, searchFilter);
            }

            $('#loading').show();


            function loadData(page, search = '') {
                $.ajax({
                    url: '{{ url('/stoks/getall') }}',
                    method: 'GET',
                    data: {
                        page: page,
                        search: search
                    },
                    success: function(response) {
                        $('#loading').hide();

                        $('#additional_Info').empty();


                        if (response.data.length > 0) {
                            $.each(response.data, function(index, item) {
                                var accordionId = item.id;
                                var newTitle = item.name;
                                var accordionContent = `
                                <div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
                                    <div class="rounded shadow py-5 px-4">
                                        <div class="icon"> <i class="fas fa-leaf"></i>
                                        </div>
                                        <h3 class="mb-3">${newTitle}</h3>
                                        
                                        <strong class="p-1 bg-${item.stok > 0 ? 'warning' : 'danger'} text-${item.stok > 0 ? 'black' : 'white'} " style="border-radius:10px;">
                                            ${item.stok > 0 ? 'Tersedia ' +item.stok + ' Kg': 'Stok Kosong'}
                                        </strong>
    
                                        <p class="my-3"> 
                                            <strong class="text-success">Umur Tanaman</strong><br>
                                                <span>± ${item.umur} Hari setelah sebar</span><br>
                                                <strong class="text-success">Potensi Hasil</strong><br>
                                                <span>± ${item.potensi_hasil} t/ha</span>
                                        </p>
                                        <a class="btn btn-sm btn-outline-primary" href="{{ url('detail_stoks/${accordionId}') }}">Lihat <i
                                                class="fa fa-arrow-right ms-1"></i></a>
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
                        $('#pagination').html(generatePaginationLinks(response));

                        // $('#pagination').html(response.links);
                    },
                    error: function() {
                        console.log('Gagal mengambil data');
                    }
                });
            }

            // Memuat data pertama kali saat halaman dimuat
            loadData(1);

            // Memuat data ketika tautan paginasi diklik
            $(document).on('click', '#pagination a', function(e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                loadData(page);
            });

            function generatePaginationLinks(response) {
                var paginationHtml = '';
                paginationHtml += '<ul class="pagination justify-content-center">';

                // Tautan sebelumnya
                if (response.prev_page_url !== null) {
                    paginationHtml += '<li class="page-item"><a class="page-link" href="' + response
                        .prev_page_url +
                        '"><</a></li>';
                }

                // Tautan halaman
                for (var i = 1; i <= response.last_page; i++) {
                    var activeClass = (i === response.current_page) ? 'active' : '';
                    paginationHtml += '<li class="page-item ' + activeClass + '"><a class="page-link" href="' +
                        '{{ url('/varietas/getall') }}?page=' + i + '">' + i + '</a></li>';
                }

                // Tautan berikutnya
                if (response.next_page_url !== null) {
                    paginationHtml += '<li class="page-item"><a class="page-link" href="' + response
                        .next_page_url +
                        '">></a></li>';
                }

                paginationHtml += '</ul>';
                return paginationHtml;
            }

        });
    </script>
@endpush
