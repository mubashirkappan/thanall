@extends('welcome')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard</h2>
    <div class="row">
        <!-- Users List Card -->
        @auth
        @if(auth()->user()->is_admin)
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Users List</h5>
                    <p class="card-text">View and manage all users.</p>
                    <a href="{{ route('user.show') }}" class="btn btn-light">Go to Users</a>
                </div>
            </div>
        </div>
        @endif
        @endauth
        <!-- Types Card -->
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <p class="card-text">Manage user Category.</p>
                    <a href="{{ route('type.index') }}" class="btn btn-light">View Category</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Transactions</h5>
                    <p class="card-text">Manage transactions.</p>
                    @php
                    $id = auth()->user()->is_admin ? null : auth()->user()->id;
                    @endphp

                    <a href="{{ route('user.view',$id) }}" class="btn btn-light">View Transactions</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Payment method</h5>
                    <p class="card-text">Manage payment method.</p>
                    <a href="{{ route('payment.index') }}" class="btn btn-light">Payment Methods</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection