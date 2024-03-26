@push('js')
    <script>
        $(function() {
            $('#datatable-sertifikasi').DataTable({
                processing: true,
                serverSide: true,
                // responsive: true,
                ajax: '{{ url('sertifikasis-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'identitas',
                        name: 'identitas'
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
            window.editLaboratorium = function(id) {
                $('#modal-uji-lab-' + id).modal('show');
            };
            window.openFase = function(value) {
                $('#modal-' + value).modal('show');
            };

            // Memperbarui fungsi window.editFaseVegetatif
            window.editFaseVegetatif = function(id) {
                $('#modal-edit-fase_vegetatif-' + id).modal('show');
                $.ajax({
                    url: '/sertifikasi/vegetatif/' + id,
                    type: 'GET',
                    success: function(response) {
                        for (var i = 0; i < response.data.length; i++) {
                            $('#idVegetatif' + id).val(response.data[i].id);
                            $('#hamaPenyakitEdit-' + id).val(response.data[i].hama_penyakit);
                            $('#kemurnianEdit-' + id).val(response.data[i].kemurnian);
                            $('#pemeriksaanEdit-' + id).val(response.data[i].pemeriksaan);
                            $('#keadaanRumputEdit-' + id).val(response.data[i].keadaan_rumput);
                            $('#taksiranHasilEdit-' + id).val(response.data[i].taksiran_hasil);
                            $('#catatanVegetatifEdit-' + id).val(response.data[i].catatan);

                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };

            // Memperbarui fungsi window.editFaseBerbunga
            window.editFaseBerbunga = function(id) {
                $('#modal-edit-fase_berbunga-' + id).modal('show');
                $.ajax({
                    url: '/sertifikasi/berbunga/' + id,
                    type: 'GET',
                    success: function(response) {
                        for (var i = 0; i < response.data.length; i++) {
                            $('#idBerbunga' + id).val(response.data[i].id);
                            $('#hamaPenyakitBerbungaEdit-' + id).val(response.data[i]
                                .Hama_penyakit);
                            $('#kemurnianBerbungaEdit-' + id).val(response.data[i].kemurnian);
                            $('#pemeriksaanBerbungaEdit-' + id).val(response.data[i].pemeriksaan);
                            $('#keadaanRumputBerbungaEdit-' + id).val(response.data[i]
                                .keadaan_rumput);
                            $('#taksiranHasilBerbungaEdit-' + id).val(response.data[i]
                                .taksiran_hasil);
                            $('#catatanBerbungaEdit-' + id).val(response.data[i].catatan);

                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };

            // Memperbarui fungsi window.editFaseMasak
            window.editFaseMasak = function(id) {
                $('#modal-edit-fase_masak-' + id).modal('show');
                $.ajax({
                    url: '/sertifikasi/masak/' + id,
                    type: 'GET',
                    success: function(response) {
                        for (var i = 0; i < response.data.length; i++) {
                            $('#idMasak' + id).val(response.data[i].id);
                            $('#hamaPenyakitMasakEdit-' + id).val(response.data[i].Hama_penyakit);
                            $('#kemurnianMasakEdit-' + id).val(response.data[i].kemurnian);
                            $('#pemeriksaanMasakEdit-' + id).val(response.data[i].pemeriksaan);
                            $('#keadaanRumputMasakEdit-' + id).val(response.data[i].keadaan_rumput);
                            $('#taksiranHasilMasakEdit-' + id).val(response.data[i].taksiran_hasil);
                            $('#catatanMasakEdit-' + id).val(response.data[i].catatan);
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };

            // Memperbarui fungsi window.editFasePendahuluan
            window.editFasePendahuluan = function(id) {
                $('#modal-edit-fase_pendahuluan-' + id).modal('show');
                $.ajax({
                    url: '/sertifikasi/pendahuluan/' + id,
                    type: 'GET',
                    success: function(response) {
                        for (var i = 0; i < response.data.length; i++) {
                            $('#idPendahuluan' + id).val(response.data[i].id);
                            $('#tanamanUtaraEdit-' + id).val(response.data[i].tanaman_utara);
                            $('#tanamanSelatanEdit-' + id).val(response.data[i].tanaman_selatan);
                            $('#tanamanTimurEdit-' + id).val(response.data[i].tanaman_timur);
                            $('#tanamanBaratEdit-' + id).val(response.data[i].tanaman_barat);
                            $('#bekasTanamanEdit-' + id).val(response.data[i].bekas_tanam);
                            $('#bekasBeroEdit-' + id).val(response.data[i].bekas_bero);
                            $('#catatanPendahuluanEdit-' + id).val(response.data[i].catatan);
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };

            // Memperbarui fungsi window.editAlatPanen
            window.editAlatPanen = function(id) {
                $('#modal-edit-pemeriksaan_alat_panen-' + id).modal('show');
                $.ajax({
                    url: '/sertifikasi/panen/' + id,
                    type: 'GET',
                    success: function(response) {
                        for (var i = 0; i < response.data.length; i++) {
                            $('#idPanen' + id).val(response.data[i].id);
                            $('#luasPemeriksaanPanenEdit-' + id).val(response.data[i]
                                .luas_pemeriksaan);
                            $('#luasPanenPanenEdit-' + id).val(response.data[i].luas_panen);
                            $('#hasilPanenPanenEdit-' + id).val(response.data[i].hasil_panen);
                            $('#catatanPanenEdit-' + id).val(response.data[i].catatan);
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            // Memperbarui fungsi window.editUjiLab 
            window.editUjiLab = function(id) {
                $('#modal-edit-uji-lab-' + id).modal('show');
                $.ajax({
                    url: '/sertifikasi/uji_lab/' + id,
                    type: 'GET',
                    success: function(response) {
                        for (var i = 0; i < response.data.length; i++) {
                            $('#idUjiLab' + id).val(response.data[i].id);
                            $('#nomorInduk-' + id).val(response.data[i]
                                .nomor_induk);
                            $('#nomorSertifikat-' + id).val(response.data[i]
                                .nomor_sertifikat);
                            $('#musimTanam-' + id).val(response.data[i]
                                .musim_tanam);
                            $('#nomorKelompok-' + id).val(response.data[i]
                                .nomor_kelompok);
                            $('#tanggalPanen-' + id).val(response.data[i]
                                .tanggal_panen);
                            $('#tanggalLabel-' + id).val(response.data[i]
                                .tanggal_label);
                            $('#tanggalSelesaiPengujian-' + id).val(response.data[i]
                                .tanggal_selesai_pengujian);
                            $('#campuranVarietasLain-' + id).val(response.data[i]
                                .campuran_varietas_lain);
                            $('#volume-' + id).val(response.data[i]
                                .volume);
                            $('#kadarAir-' + id).val(response.data[i]
                                .kadar_air);
                            $('#benihMurni-' + id).val(response.data[i]
                                .benih_murni);
                            $('#kotoranBenih-' + id).val(response.data[i]
                                .kotoran_benih);
                            $('#dayaBerkecambah-' + id).val(response.data[i]
                                .daya_berkecambah);
                            $('#kesehatanBenih-' + id).val(response.data[i]
                                .kesehatan_benih);
                            $('#bijiGulma-' + id).val(response.data[i]
                                .biji_gulma);
                            $('#catatanLabEdit-' + id).val(response.data[i].catatan);
                        }
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
