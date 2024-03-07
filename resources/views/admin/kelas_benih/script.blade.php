@push('js')
    <script>
        $(function() {
            $('#datatable-kelas-benih').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('kelas-benih-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
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
                $('#datatable-kelas-benih').DataTable().ajax.reload();
            });
            window.editKelasBenih = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/kelas_benih/edit/' + id,
                    success: function(response) {
                        $('#customersModalLabel').text('Edit kelas benih');
                        $('#formKelasBenihId').val(response.id);
                        $('#formKelasBenihName').val(response.name);
                        $('#formKelasBenihCode').val(response.code);
                        $('#formKelasBenihPrice').val(response.price);
                        $('#formKelasBenihDescription').val(response.description);
                        $('#kelasBenihModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveKelasBenihBtn').click(function() {
                var formData = $('#kelasBenihForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/kelas_benih/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-kelas-benih').DataTable().ajax.reload();
                        $('#kelasBenihModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createKelasBenihBtn').click(function() {
                var formData = $('#createKelasBenihForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/kelas_benih/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#customersModalLabel').text('Edit varietas');
                        $('#formKelasBenihName').val('');
                        $('#formKelasBenihDescription').val('');
                        $('#datatable-kelas-benih').DataTable().ajax.reload();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteKelasBenih = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus kelas ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/kelas_benih/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-kelas-benih').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
        });
    </script>
@endpush
