@extends('welcome')

@section('title', 'Payment Method List')

@section('content')
<div class="row mt-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card p-4 shadow">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Payment Method List</h4>
                <a href="{{ route('payment.create') }}" class="btn btn-primary">Add Payment Method</a>
            </div>

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <table class="table table-bordered text-center">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        @auth
                        @if(auth()->user()->is_admin)
                        <th>User</th>
                        @endif
                        @endauth
                        <th>Title</th>
                        <th>Balance</th>
                        <th>Actions</th> {{-- only one Title, then Actions --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($methods as $method)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @auth
                        @if(auth()->user()->is_admin)
                        <td>{{ $method->user->f_name ?? 'N/A' }}</td>
                        @endif
                        @endauth
                        <td>{{ $method->title }}</td>
                        <td>{{ $method->balance }}</td>
                        <td>
                            <a href="{{ route('payment.edit', $method->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('payment.delete', $method->id) }}" class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No payment methods found.</td>
                    </tr>
                    @endforelse
                    <tr>
                    <th colspan="2">Total Balance</th>
                        <th>{{ $methods->sum('balance') }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
