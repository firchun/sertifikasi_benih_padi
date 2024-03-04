@push('js')
    <script>
        $(function() {
            $('#datatable-penangkars').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('penangkars-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },


                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'koordinat',
                        name: 'koordinat'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $('.create-new').click(function() {
                $('#create').modal('show');
                getKecamatanOptions();
            });
            $('.refresh').click(function() {
                $('#datatable-penangkars').DataTable().ajax.reload();
            });
            window.editDesa = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/desa/edit/' + id,
                    success: function(response) {
                        $('#customersModalLabel').text('Edit desa');
                        $('#formDesaId').val(response.id);
                        $('#formDesaName').val(response.name);
                        $('#formDesaDescription').val(response.description);
                        $('#desaModal').modal('show');
                        getKecamatanOptions(response.id_kecamatan);
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveDesaBtn').click(function() {
                var formData = $('#desaForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/desa/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-desa').DataTable().ajax.reload();
                        $('#desaModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createDesaBtn').click(function() {
                var formData = $('#createDesaForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/desa/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#customersModalLabel').text('Edit desa');
                        $('#formDesaName').val('');
                        $('#formDesaDescription').val('');
                        $('#datatable-desa').DataTable().ajax.reload();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteDesa = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus desa ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/desa/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-desa').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };

            function getKecamatanOptions(unitValue) {
                $.ajax({
                    url: '/kecamatan/getall',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#formKecamatanIdKecamatan').empty();
                        $('#formKecamatanIdKecamatanCreate').empty();

                        $('#selectKecamatan').empty();
                        $('#selectKecamatan').append(
                            '<option value="-" >Pilih Kecamatan</option>');
                        $.each(data, function(index, kecamatan) {
                            $('#selectKecamatan').append('<option value="' +
                                kecamatan.id +
                                '" >' +
                                kecamatan.name +
                                '</option>');
                        });

                        $.each(data, function(index, kecamatan) {
                            $('#formKecamatanIdKecamatanCreate').append(
                                '<option value="' +
                                kecamatan.id +
                                '" >' +
                                kecamatan.name +
                                '</option>');

                        });

                        $.each(data, function(index, kecamatan) {
                            var selected = (kecamatan.id === unitValue) ? 'selected' :
                                '';
                            $('#formKecamatanIdKecamatan').append('<option value="' +
                                kecamatan.id +
                                '" ' +
                                selected + '>' +
                                kecamatan.name +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan: ' + error);
                    }
                });
            }

        });
    </script>
@endpush
