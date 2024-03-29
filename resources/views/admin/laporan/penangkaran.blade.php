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

                        <div class="col-md-3 col-12">
                            <div class="input-group">
                                <span class="input-group-text">Verifikasi</span>
                                <select id="selectVerifikasi" name="varifikasi" class="form-select">
                                    <option value="">Semua</option>
                                    <option value="true">Sudah</option>
                                    <option value="false">belum</option>
                                </select>
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
                    <table id="datatable-penangkars" class="table table-hover table-bordered display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nama Penangkaran</th>
                                <th>Nama Ketua</th>
                                <th>Alamat</th>
                                <th>Koordinat</th>
                                <th>Verifikasi</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Nama Penangkaran</th>
                                <th>Nama Ketua</th>
                                <th>Alamat</th>
                                <th>Koordinat</th>
                                <th>Verifikasi</th>
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
            var table = $('#datatable-penangkars').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ url('penangkars-datatable') }}',
                    data: function(d) {
                        d.selectVerifikasi = $('#selectVerifikasi').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
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
                        data: 'verifikasi_text',
                        name: 'verifikasi_text'
                    },

                ],
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'pdf',
                        text: '<i class="bx bxs-file-pdf"></i> PDF',
                        className: 'btn-danger mx-3',
                        title: 'Data Laporan Penangkaran Benih',
                        orientation: 'potrait',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible' // Ekspor seluruh kolom yang terlihat
                        },
                        customize: function(doc) {
                            doc.styles.tableHeader.fillColor = '#2a6908';
                        },
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="bx bxs-file-export"></i> Excel',
                        className: 'btn-success',
                        exportOptions: {
                            columns: ':visible' // Ekspor seluruh kolom yang terlihat
                        }
                    }
                ]
            });
            $('#filter').click(function() {
                table.ajax.url('{{ url('penangkars-datatable') }}?verifikasi=' + $(
                    '#selectVerifikasi').val()).load();
            });
            $('.refresh').click(function() {
                $('#datatable-penangkars').DataTable().ajax.reload();
            });
        })
    </script>
    <!-- JS DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
@endpush
