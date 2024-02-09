@extends('layouts.backend.admin')

@section('content')
    <div class="row">
        @include('admin.dashboard_component.card1', [
            'count' => $users,
            'title' => 'Users',
            'subtitle' => 'Total users',
            'color' => 'primary',
            'icon' => 'user',
        ])
        @include('admin.dashboard_component.card1', [
            'count' => $customers,
            'title' => 'Customers',
            'subtitle' => 'Total Customers',
            'color' => 'success',
            'icon' => 'user',
        ])
    </div>
@endsection
