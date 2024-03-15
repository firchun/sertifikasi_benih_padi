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
                    <table id="datatable-penangkars" class="table table-hover table-bordered display">
                        <thead>
                            <tr>
                                <th>ID</th>
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

                ]
            });

            $('.refresh').click(function() {
                $('#datatable-penangkars').DataTable().ajax.reload();
            });
        })
    </script>
@endpush
