@extends('welcome')

@section('title', 'Edit Payment Method')

@section('content')
<div class="container mt-5">
    <h2>Edit Payment Method</h2>

    <form action="{{ route('payment.update', $paymentMethod->id) }}" method="POST">
        @csrf
        @method('POST')
        @auth
        @if(auth()->user()->is_admin)
        <div class="form-group mb-3">
            <label for="user_id" class="form-label">Users</label>
            <select name="user_id" class="form-select">
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $paymentMethod->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->f_name }}
                </option>
                @endforeach
            </select>
        </div>

        @endif
        @endauth
        <div class="mb-3">
            <label for="title" class="form-label">Method Title</label>
            <input type="text" name="title" class="form-control" value="{{ $paymentMethod->title }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Balance</label>
            <input type="text" name="balance" class="form-control" value="{{ $paymentMethod->balance }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
