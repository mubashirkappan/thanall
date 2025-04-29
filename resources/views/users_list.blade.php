@extends('welcome')

@section('title', 'Users List')

@section('content')
<div class="row mt-5">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card p-4 shadow">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Users List</h4>
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus"></i> Add User
                </a>
            </div>

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <table class="table table-bordered text-center">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Job</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->f_name }}</td>
                        <td>{{ $user->l_name }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->job }}</td>
                        <td>{{ $user->adress }}</td>
                        <td>
                            <div class="btn-group" role="group">
                            @auth
                            @if(!$user->is_admin)
                            <a href="{{ route('user.entry', $user->id) }}" class="btn btn-sm btn-success">Entry</a>
                            <a href="{{ route('user.view', $user->id) }}" class="btn btn-sm btn-primary">View</a>
                            @endif
                            @endauth
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('user.delete', $user->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
