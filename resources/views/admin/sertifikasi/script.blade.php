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
                        data: 'tanaman',
                        name: 'tanaman'
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

                $('#sertifikasiModal' + id).modal('show');

            };
            window.openFase = function(value) {
                $('#modal-' + value).modal('show');
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
    <script>
        // Menangani event saat modal ditampilkan
        $('.modal').on('show.bs.modal', function() {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });
        // Mengatur kembali scrollbar ke atas saat modal ditutup
        $('.modal').on('hidden.bs.modal', function() {
            $('.modal:visible').length && $('body').addClass('modal-open');
        });
    </script>
@endpush
