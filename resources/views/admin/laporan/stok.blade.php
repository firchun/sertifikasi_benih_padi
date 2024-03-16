@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label ">
                        <h5 class="card-title mb-0">{{ $title ?? 'Title' }}</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class=" btn-group " role="group">
                            <button class="btn btn-secondary refresh btn-default" type="button">
                                <span>
                                    <i class="bx bx-sync me-sm-1"> </i>
                                    <span class="d-none d-sm-inline-block">Refresh</span>
                                </span>
                            </button>

                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="datatable-sertifikasi" class="table table-hover table-bordered table-sm display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kelompok Tani</th>
                                <th>Nama Pimpinan</th>
                                <th>Kampung</th>
                                <th>Varietas</th>
                                <th>Kelas Benih</th>
                                <th>Harga Benih</th>
                                <th>Luas</th>
                                <th>No. Blok</th>
                                <th>Tanam</th>
                                <th>Ttitk Koordinat</th>
                                <th>Stok Benih</th>
                                <th>Kemasan (25 kg)</th>
                                <th>Status Sertifikasi</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kelompok Tani</th>
                                <th>Nama Pimpinan</th>
                                <th>Kampung</th>
                                <th>Varietas</th>
                                <th>Kelas Benih</th>
                                <th>Harga Benih</th>
                                <th>Luas</th>
                                <th>No. Blok</th>
                                <th>Tanam</th>
                                <th>Titik Koordinat</th>
                                <th>Stok Benih</th>
                                <th>Kemasan (25 kg)</th>
                                <th>Status Sertifikasi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $('#datatable-sertifikasi').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                scrollX: true,
                autoWidth: true,

                ajax: '{{ url('sertifikasis-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'penangkar',
                        name: 'penangkar'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'desa.name',
                        name: 'desa.name'
                    },

                    {
                        data: 'varietas.name',
                        name: 'varietas.name'
                    },
                    {
                        data: 'kelas_benih.code',
                        name: 'kelas_benih.code'
                    },
                    {
                        data: 'kelas_benih.price',
                        name: 'kelas_benih.price'
                    },
                    {
                        data: 'luas_lahan',
                        name: 'luas_lahan'
                    },
                    {
                        data: 'blok',
                        name: 'blok'
                    },
                    {
                        data: 'tanggal_tanam',
                        name: 'tanggal_tanam'
                    },

                    {
                        data: 'koordinat',
                        name: 'koordinat'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'kemasan',
                        name: 'kemasan'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                ],
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'pdf',
                        text: '<i class="bx bxs-file-pdf"></i> PDF',
                        className: 'btn-danger mx-3',
                        orientation: 'landscape',
                        title: 'Data Laporan Stok Benih Tersertifikasi',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 8;
                            doc.styles.tableHeader.fillColor = '#2a6908';


                        },
                        header: true
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="bx bxs-file-export"></i> Excel',
                        className: 'btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
            $('.refresh').click(function() {
                $('#datatable-sertifikasi').DataTable().ajax.reload();
            });
        });
    </script>

    <!-- JS DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
@endpush
