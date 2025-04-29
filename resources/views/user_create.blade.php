@extends('welcome')

@section('title', 'Create User')

@section('content')
<div class="container mt-5">
    <h2>Create New User</h2>

    <form action="{{ route('user.save') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" name="firstName" class="form-control" required />
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" name="lastName" class="form-control" required />
            </div>
            <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option disabled selected>Choose...</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" />
            </div>
            <div class="col-md-6 mb-3">
                <label for="emailAddress" class="form-label">Email</label>
                <input type="email" name="emailAddress" class="form-control" required />
            </div>
            <div class="col-md-6 mb-3">
                <label for="phoneNumber" class="form-label">Phone</label>
                <input type="tel" name="phoneNumber" class="form-control" required />
            </div>
            <div class="col-md-6 mb-3">
                <label for="job" class="form-label">Job</label>
                <input type="text" name="job" class="form-control" />
            </div>
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required />
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2">
        <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>

            <!-- <a href="{{ route('user.list') }}" class="btn btn-secondary">Cancel</a> -->
            <button type="submit" class="btn btn-success">Create User</button>
        </div>
    </form>
</div>
@endsection
