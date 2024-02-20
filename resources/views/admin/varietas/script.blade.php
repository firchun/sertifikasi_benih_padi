@push('js')
    <script>
        $(function() {
            $('#datatable-varietas').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('varietas-datatable') }}',
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
                $('#datatable-varietas').DataTable().ajax.reload();
            });
            window.editVarietas = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/varietas/edit/' + id,
                    success: function(response) {
                        $('#customersModalLabel').text('Edit varietas');
                        $('#formVarietasId').val(response.id);
                        $('#formVarietasName').val(response.name);
                        $('#formVarietasDescription').val(response.description);
                        $('#varietasModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            $('#saveVarietasBtn').click(function() {
                var formData = $('#varietasForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/varietas/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-varietas').DataTable().ajax.reload();
                        $('#varietasModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createVarietasBtn').click(function() {
                var formData = $('#createVarietasForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/varietas/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#customersModalLabel').text('Edit varietas');
                        $('#formVarietasrName').val('');
                        $('#formVarietasrDescription').val('');
                        $('#datatable-varietas').DataTable().ajax.reload();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.deleteVarietas = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus varietas ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/varietas/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-varietas').DataTable().ajax.reload();
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
