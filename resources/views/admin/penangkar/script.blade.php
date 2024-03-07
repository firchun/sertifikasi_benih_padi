@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAP_API_KEY') }}&callback=initializeMap"></script>
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
                        data: 'verifikasi',
                        name: 'verifikasi'
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

            window.detailPenangkar = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/penangkars/detail/' + id,
                    success: function(response) {
                        $('#detailModalLabel').text('Detail Modal');
                        $('#Nama').text(response.nama);
                        $('#Ketua').text(response.user.name);
                        $('#Alamat').text(response.alamat);
                        $('#Jenis').text(response.jenis);
                        $('#Jumlah_anggota').text(response.jumlah_anggota + ' Orang');
                        $('#detailModal').modal('show');

                        // Call initializeMap function after modal is shown
                        $('#detailModal').on('shown.bs.modal', function() {
                            initializeMap(response);
                        });
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            window.verifikasiPenangkar = function(id) {
                $.ajax({
                    type: 'POST',
                    url: '/penangkars/verifikasi/' + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Verifikasi berhasil');
                        $('#datatable-penangkars').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };

            // Define initializeMap function
            function initializeMap(response) {
                var center = new google.maps.LatLng(response.latitude, response.longitude);
                var mapOptions = {
                    zoom: 12,
                    center: center,
                    zoomControl: true,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                };
                var map = new google.maps.Map(document.getElementById('gmap'), mapOptions);



                // Create marker position using latitude and longitude
                var pos = new google.maps.LatLng(parseFloat(response.latitude), parseFloat(response.longitude));

                // Create marker content
                var content = `
                        <div class="popupContent" style="width:200px;">
                            <div class="text-center justify-content-center text-black">
                                <strong>Penangkar ${response.nama}</strong>
                                <hr>
                                <br><strong>Nama Penangkaran :</strong><br> ${response.nama}<br>
                                <strong>Ketua Penangkaran :</strong> <br>${response.user.name}
                                <div class="mt-4">
                                    <a href="https://maps.google.com/?saddr=My+Location&daddr=${response.latitude},${response.longitude}" target="_blank" class="btn btn-primary btn-sm" style="padding:10px;">Rute</a>
                                </div>
                            </div>
                        </div>
                    `;

                // Create marker icon
                var icon = {
                    url: '{{ asset('img/marker.png') }}',
                    scaledSize: new google.maps.Size(30, 41)
                };

                // Create the marker
                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: icon
                });

                // Marker click listener
                google.maps.event.addListener(marker, 'click', function() {
                    var infowindow = new google.maps.InfoWindow({
                        content: content
                    });
                    infowindow.open(map, marker);
                });
            }
        });
    </script>
@endpush
