@extends('layouts.backend.admin')
@push('css')
    <style>
        /* CSS untuk perangkat dengan lebar layar >= 768px */
        .dtr-hidden {
            display: block !important;
        }

        @media (min-width: 768px) {

            .dtr-hidden .btn-group {
                display: hidden !important;
            }
        }
    </style>
@endpush
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
                            {{-- <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#create">
                                <span>
                                    <i class="bx bx-plus me-sm-1"> </i>
                                    <span class="d-none d-sm-inline-block">Daftar Penangkaran Baru</span>
                                </span>
                            </button> --}}
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="datatable-sertifikasi" class="table table-hover table-bordered table-sm display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Penangkaran</th>
                                <th>Alamat</th>
                                <th>Tanaman</th>
                                <th>Status</th>
                                <th style="min-width: 300px;">Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Penangkaran</th>
                                <th>Alamat</th>
                                <th>Tanaman</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('admin.sertifikasi.components.modal') --}}
@endsection
@include('admin.sertifikasi.script')
