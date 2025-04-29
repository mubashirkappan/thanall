@extends('welcome')

@section('title', 'Create Payment Method')

@section('content')
<div class="container mt-5">
    <h2>Create New Payment Method</h2>

    <form action="{{ route('payment.store') }}" method="POST">
        @csrf
        @auth
        @if(auth()->user()->is_admin)
        <div class="form-group mb-3">
            <label for="user_id" class="form-label">Users</label>
            <select name="user_id" class="form-select">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->f_name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        @endauth
        <div class="mb-3">
            <label for="title" class="form-label">Method Title</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Balance</label>
            <input type="text" name="balance" class="form-control" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection