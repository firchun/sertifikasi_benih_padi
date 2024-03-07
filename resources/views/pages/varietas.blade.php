@extends('layouts.app')
@section('content')
    <section class="page-header bg-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center">
                    <h2 class="mb-3 text-capitalize">{{ $title ?? 'Varietas Unggulan' }}</h2>
                    <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                        <li class="list-inline-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="list-inline-item">/ &nbsp; <a href="{{ url('/stoks') }}">{{ $title }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center mb-3">
                <div class="col-lg-6 mb-4">
                    <input type="text" class="form-control  bg-white border-success" style="border-radius: 20px;"
                        id="search" placeholder="Cari Varietas disini....">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Tampilan loading -->
                    <div id="loading" style="display: none; text-align: center;">
                        <h4>Harap Tunggu....</h4>
                    </div>
                    <div class="accordion accordion-border-bottom" id="additional_Info">
                        <!-- Placeholder untuk item accordion yang akan ditambahkan -->
                    </div>
                    <div id="pagination" class="mt-3">
                        <!-- Placeholder untuk tautan paginasi -->
                    </div>
                </div>
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
                loadData(1, searchFilter);
                $('#loading').show();
            }
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
                        if (response.data.length > 0) {
                            $.each(response.data, function(index, item) {
                                var accordionId = item.id;
                                var newTitle = item.name;
                                var accordionContent = `
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header accordion-button h5 border-0"
                                        id="heading-${accordionId}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-${accordionId}" aria-expanded="false"
                                        aria-controls="collapse-${accordionId}">${newTitle}
                                    </h2>
                                    <div id="collapse-${accordionId}"
                                        class="accordion-collapse border-0 collapse"
                                        aria-labelledby="heading-${accordionId}"
                                        data-bs-parent="#additional_Info" style="">
                                        <div class="accordion-body py-0 content">
                                            
                                            <strong>Umur Tanaman</strong>
                                            <p>± ${item.umur} Hari setelah sebar</p>
                                            <strong>Potensi Hasil</strong>
                                            <p>± ${item.potensi_hasil} t/ha</p>
                                            <strong>Anjuran Penanaman Benih</strong>
                                            <p>${item.anjuran_tanam}</p>
                                            <strong>Ketahanan  Terhadap Hama</strong>
                                            <p>${item.ketahanan_hama}</p>
                                            <strong>Ketahanan Terhadap Penyakit</strong>
                                            <p>${item.ketahanan_penyakit}</p>
                                            <strong>Ketahanan  Terhadap Abiotik</strong>
                                            <p>${item.ketahanan_abiotik}</p>
                                        </div>
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
