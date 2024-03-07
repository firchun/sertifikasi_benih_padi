<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    {{-- <p class="text-primary text-uppercase fw-bold mb-3">Our Service Holders</p> --}}
                    <h1 class="mb-4">Stok Benih</h1>
                    <p class="text-black mb-0">Berikut merupakan daftar Stok <b>Benih Bersertifikat</b> yang ada di
                        Kabupaten
                        Merauke</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" id="additional_Info">
            <div id="loading" style="display: none; text-align: center;">
                <h4>Harap Tunggu....</h4>
            </div>
        </div>
        <div class="mt-4 text-center">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('stoks') }}">Semua Stok Benih <i
                    class="las la-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>
@push('js')
    <script>
        $(document).ready(function() {
            $('#loading').show();

            function loadData() {
                $.ajax({
                    url: '{{ url('/stoks/getthree') }}',
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

                        // $('#pagination').html(response.links);
                    },
                    error: function() {
                        console.log('Gagal mengambil data');
                    }
                });
            }

            loadData();

        });
    </script>
@endpush
