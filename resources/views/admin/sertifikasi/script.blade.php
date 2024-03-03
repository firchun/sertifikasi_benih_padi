@push('js')
    <script>
        $(function() {
            $('#datatable-sertifikasi').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('sertifikasis-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        data: 'luas_pertanaman',
                        name: 'luas_pertanaman'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $('.refresh').click(function() {
                $('#datatable-sertifikasi').DataTable().ajax.reload();
            });
            window.editSertifikasi = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/desa/edit/' + id,
                    success: function(response) {
                        $('#customersModalLabel').text('Edit desa');
                        $('#formDesaId').val(response.id);
                        $('#formDesaName').val(response.name);
                        $('#formDesaDescription').val(response.description);
                        $('#desaModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };

            window.terimaPermohonan = function(id) {
                $.ajax({
                    url: '/sertifikasi/terima/' + id,
                    type: 'POST',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#datatable-sertifikasi').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            window.tolakPermohonan = function(id) {
                $.ajax({
                    url: '/sertifikasi/tolak/' + id,
                    type: 'POST',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#datatable-sertifikasi').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };

        });
    </script>
@endpush
