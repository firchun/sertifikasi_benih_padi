<section class="section">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center">
                    {{-- <p class="text-primary text-uppercase fw-bold mb-3">Our Service Holders</p> --}}
                    <h1 class="mb-4">Testimoni</h1>
                    <p class="lead mb-0">Berikut merupakan testimoni penggunaan benih bersertifiikat</p>
                    <a type="button" class="btn btn-outline-primary" href="#" data-bs-toggle="modal"
                        data-bs-target="#applyLoan">Berikan testimoni<span style="font-size: 14px;"
                            class="ms-2 fas fa-arrow-right"></span></a>
                </div>
            </div>
        </div>
        <div class="row position-relative justify-content-center mb-4" id="TestimoniCard">
            {{-- //testimoni --}}
        </div>
    </div>
</section>
<div class="modal applyLoanModal fade" id="applyLoan" tabindex="-1" aria-labelledby="applyLoanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title" id="exampleModalLabel">Berikan testimoni anda saat menggunakan benih
                    bersertifikat</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 mb-4 pb-2">
                            <div class="form-group">
                                <label for="nama" class="form-label">Foto (Opsional)</label>
                                <input type="file" class="form-control shadow-none" id="file" name="image">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 pb-2">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Anda</label>
                                <input type="text" class="form-control shadow-none" id="nama" name="nama">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 pb-2">
                            <div class="form-group">
                                <label for="sebagai" class="form-label">Sebagai</label>
                                <input type="text" class="form-control shadow-none" id="sebagai" name="sebagai">
                            </div>
                        </div>
                        {{-- <div class="col-lg-12 mb-4 pb-2">
                            <div class="form-group">
                                <label for="sebagai" class="form-label">Sebagai</label>
                                <select id="sebagai" name="sebagai" class="form-control">
                                    <option value="Masyarakat">Masyarakat</option>
                                    <option value="Penangkar">Penangkar</option>
                                    <option value="Kelompok Tani">Kelompok Tani</option>
                                    <option value="Pegawai BBU">Pegawai BBU</option>
                                    <option value="Pegawai BBI">Pegawai BBI</option>
                                    <option value="ppl">PPL</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-12 mb-4 pb-2">
                            <div class="form-group">
                                <label for="testimoni" class="form-label">Testimoni anda</label>
                                <textarea class="form-control shadow-none" id="testimoni" name="testimoni"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary w-100">Kirim Testimoni</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#form').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: '/testimoni/store',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response.message);
                        $('#applyLoan').modal('hide');
                        getTestimoniCard();
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function getTestimoniCard() {
            $.ajax({
                url: '/testimoni/getall',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#TestimoniCard').empty();

                    $.each(data, function(index, testimoni) {
                        var imageHtml = '';
                        if (testimoni.image != null) {
                            imageHtml =
                                `<img src="${testimoni.imgsrc}" id="image" alt="testimoni" style="width:100%">`;
                        }
                        $('#TestimoniCard').append(
                            `<div class="col-lg-4 col-md-6 pt-1">
                        <div class="shadow rounded bg-white p-4 mt-4">
                            <div class="d-block d-sm-flex align-items-center mb-3">
                                <div class="mt-3 mt-sm-0 ms-0 ms-sm-3">
                                    <h4 class="h5 mb-1">${testimoni.nama}</h4>
                                    <p class="mb-0"> ${testimoni.sebagai}  </p>
                                </div>
                            </div>
                            <div class="content text-success">
                                ${imageHtml}
                                <i> "${testimoni.testimoni}"</i>
                            </div>
                        </div>
                    </div>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan: ' + error);
                }
            });
        }
        getTestimoniCard();
    </script>
@endpush
