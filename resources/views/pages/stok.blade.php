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
            <div class="row justify-content-center" id="additional_Info">
                <div id="loading" style="display: none; text-align: center;">
                    <h4>Harap Tunggu....</h4>
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
            $('#loading').show();

            function loadData(page, search = '') {
                $.ajax({
                    url: '{{ url('/varietas/getall') }}',
                    method: 'GET',
                    data: {
                        page: page,
                        search: search
                    }, // Hapus per_page karena sudah ada di server
                    success: function(response) {
                        $('#loading').hide();
                        // Membersihkan data sebelum memuat yang baru
                        $('#additional_Info').empty();
                        // Memuat data baru
                        $.each(response.data, function(index, item) {
                            var accordionId = item.id;
                            var newTitle = item.name;
                            var accordionContent = `
                            <div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
                                <div class="rounded shadow py-5 px-4">
                                    <div class="icon"> <i class="fas fa-leaf"></i>
                                    </div>
                                    <h3 class="mb-3">${newTitle}</h3>
                                    <h5 class=" text-danger"> Rp.
                                        187,500
                                        /Karung
                                        <br>
                                    </h5>
                                    <strong class="p-1 bg-warning text-black " style="border-radius:10px;">Tersedia 
                                        8 Ton
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
                    paginationHtml += '<li class="page-item"><a class="page-link" href="' + response.prev_page_url +
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
                    paginationHtml += '<li class="page-item"><a class="page-link" href="' + response.next_page_url +
                        '">></a></li>';
                }

                paginationHtml += '</ul>';
                return paginationHtml;
            }

        });
    </script>
@endpush
