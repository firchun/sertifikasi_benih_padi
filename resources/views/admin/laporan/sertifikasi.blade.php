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
                <hr>
                <div style="margin-left:24px; margin-right: 24px;">
                    <strong>Filter Data</strong>
                    <div class="d-flex justify-content-center align-items-center row gap-3 gap-md-0">
                        <div class="col-md-5 col-12">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal Sebar</span>
                                <input type="date" id="tanggalSebarAwal" name="tanggal_sebar_awal" class="form-control">
                                <input type="date" id="tanggalSebarAkhir" name="tanggal_sebar_akhir"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal Tanam</span>
                                <input type="date" id="tanggalTanamAwal" name="tanggal_tanam_awal" class="form-control">
                                <input type="date" id="tanggalTanamAkhir" name="tanggal_tanam_akhir"
                                    class="form-control">

                            </div>
                        </div>
                        <div class="col-md-2 col-12 ">
                            <button type="button" id="filter" class="btn btn-primary"><i class="bx bx-filter"></i>
                                Filter</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-datatable table-responsive">
                    <table id="datatable-sertifikasi" class="table table-hover table-bordered table-sm display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Penangkaran</th>
                                <th>Ketua</th>
                                <th>Alamat</th>
                                <th>Luas Tanam</th>
                                <th>Varietas</th>
                                <th>Kelas Benih</th>
                                <th>Tanggal Sebar</th>
                                <th>Tanggal Tanam</th>
                                <th>Jumlah Benih</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Penangkaran</th>
                                <th>Ketua</th>
                                <th>Alamat</th>
                                <th>Luas Tanam</th>
                                <th>Varietas</th>
                                <th>Kelas Benih</th>
                                <th>Tanggal Sebar</th>
                                <th>Tanggal Tanam</th>
                                <th>Jumlah Benih</th>
                                <th>Status</th>
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
            var table = $('#datatable-sertifikasi').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ url('sertifikasis-datatable') }}',
                    data: function(d) {
                        d.tanggalSebarAwal = $('#tanggalSebarAwal').val();
                        d.tanggalSebarAkhir = $('#tanggalSebarAkhir').val();
                        d.tanggalTanamAwal = $('#tanggalTanamAwal').val();
                        d.tanggalTanamAkhir = $('#tanggalTanamAkhir').val();
                    }
                },
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
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'luas_pertanaman',
                        name: 'luas_pertanaman'
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
                        data: 'tanggal_sebar',
                        name: 'tanggal_sebar'
                    },
                    {
                        data: 'tanggal_tanam',
                        name: 'tanggal_tanam'
                    },
                    {
                        data: 'jumlah_benih',
                        name: 'jumlah_benih'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ],
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'pdf',
                        text: '<i class="bx bxs-file-pdf"></i> PDF',
                        className: 'btn-danger mx-3',
                        orientation: 'landscape',
                        title: 'Data Laporan Sertifikasi Benih',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.fontSize = 12;
                            doc.styles.tableHeader.fontSize = 12;
                            doc.styles.tableHeader.fillColor = '#2a6908';
                        },

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
            $('#filter').click(function() {
                table.ajax.url('{{ url('sertifikasis-datatable') }}?tanggal_sebar_awal=' + $(
                        '#tanggalSebarAwal').val() + '&tanggal_sebar_akhir=' + $('#tanggalSebarAkhir')
                    .val() + '&tanggal_tanam_awal=' + $('#tanggalTanamAwal').val() +
                    '&tanggal_tanam_akhir=' + $('#tanggalTanamAkhir').val()).load();
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
