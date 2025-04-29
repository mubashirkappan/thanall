@extends('welcome')

@section('title', 'Category List')

@section('content')
<div class="row mt-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card p-4 shadow">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Category List</h4>
                <a href="{{ route('type.create') }}" class="btn btn-primary">Add Type</a>
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
                        <th>Credit/Debit</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @auth
                        @if(auth()->user()->is_admin)
                        <td>{{ $type->user->f_name ?? 'N/A' }}</td>
                        @endif
                        @endauth
                        <td>{{ ucfirst($type->credit_or_debit) }}</td>
                        <td>{{ $type->title }}</td>

                        <td>
                            <a href="{{ route('type.edit', $type->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('type.delete', $type->id) }}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No types found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection