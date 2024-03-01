@push('js')
    <script>
        $(function() {
            $('#datatable-testimoni').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('testimoni-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'testimoni',
                        name: 'testimoni'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });

            $('.refresh').click(function() {
                $('#datatable-testimoni').DataTable().ajax.reload();
            });
            window.deleteTestimoni = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus testimoni ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/testimoni/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-testimoni').DataTable().ajax.reload();
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
