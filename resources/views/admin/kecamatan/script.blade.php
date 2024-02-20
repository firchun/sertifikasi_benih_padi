@push('js')
    <script>
        $(function() {
            $('#datatable-kecamatan').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('kecamatan-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $('.create-new').click(function() {
                $('#create').modal('show');
            });
            $('.refresh').click(function() {
                $('#datatable-kecamatan').DataTable().ajax.reload();
                getKecamatanCard();
            });
            window.editKecamatan = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/kecamatan/edit/' + id,
                    success: function(response) {
                        $('#customersModalLabel').text('Edit kecamatan');
                        $('#formKecamatanId').val(response.id);
                        $('#formKecamatanName').val(response.name);
                        $('#formKecamatanDescription').val(response.description);
                        $('#kecamatanModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveKecamatanBtn').click(function() {
                var formData = $('#kecamatanForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/kecamatan/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-kecamatan').DataTable().ajax.reload();
                        getKecamatanCard();
                        $('#kecamatanModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createKecamatanBtn').click(function() {
                var formData = $('#createKecamatanForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/kecamatan/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#customersModalLabel').text('Edit kecamatan');
                        $('#formKecamatanName').val('');
                        $('#formKecamatanDescription').val('');
                        $('#datatable-kecamatan').DataTable().ajax.reload();
                        getKecamatanCard();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteKecamatan = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus kecamatan ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/kecamatan/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-kecamatan').DataTable().ajax.reload();
                            getKecamatanCard();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };

            function getKecamatanCard() {
                $.ajax({
                    url: '/kecamatan/getall',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#kecamatanCard').empty();

                        $.each(data, function(index, kecamatan) {
                            $('#kecamatanCard').append(
                                '<div class="col-md-2 col-6 mb-4"><div class="card"><div class="card-header">' +
                                kecamatan.name +
                                '</div><div class="card-body"><span class="h4 text-primary">0 Penangkar</span></div></div></div>'
                            );
                            // $.getJSON("kecamatan/" + method.id, function(
                            //     respons) {
                            //     // console.log(respons.total);
                            // });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan: ' + error);
                    }
                });
            }
            getKecamatanCard();

        });
    </script>
@endpush
