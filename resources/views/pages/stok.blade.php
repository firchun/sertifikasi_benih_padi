@extends('layouts.app')
@section('content')
    <section class="page-header bg-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center">
                    <h2 class="mb-3 text-capitalize">{{ $title ?? 'Stok Benih' }}</h2>
                    <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                        <li class="list-inline-item"><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="list-inline-item">/ &nbsp; <a href="{{ url('/stoks') }}">{{ $title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </section>
    <section class="section">
        <div class="container">

            <div class="row justify-content-center">
                <div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
                    <div class="rounded shadow py-5 px-4">
                        <div class="icon"> <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="mb-3">Student Loans</h3>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        </p> <a class="btn btn-sm btn-outline-primary" href="service-details.html">View Details <i
                                class="las la-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
                    <div class="rounded shadow py-5 px-4">
                        <div class="icon"> <i class="fas fa-house-damage"></i>
                        </div>
                        <h3 class="mb-3">Mortgage Loans</h3>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        </p> <a class="btn btn-sm btn-outline-primary" href="service-details.html">View Details <i
                                class="las la-arrow-right ms-1"></i></a>
                    </div>
                </div>
                <div class="icon-box-item text-center col-lg-4 col-md-6 mb-4">
                    <div class="rounded shadow py-5 px-4">
                        <div class="icon"> <i class="fas fa-money-check-alt"></i>
                        </div>
                        <h3 class="mb-3">Payday Loans</h3>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                        </p> <a class="btn btn-sm btn-outline-primary" href="service-details.html">View Details <i
                                class="las la-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
