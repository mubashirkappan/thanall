@extends('welcome')

@section('title', 'Create Type')

@section('content')
<div class="container mt-5">
    <h2>Create New Type</h2>

    <form action="{{ route('type.store') }}" method="POST">
        @csrf
        @auth
        @if(auth()->user()->is_admin)
        <div class="form-group mb-3">
            <label for="title" class="form-label">Users</label>
            
            <select name="user_id" class="form-select">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->f_name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        @endauth
        <div class="form-group mb-3">
            <label for="title" class="form-label">Credit Or Debit</label>

            <select name="credit_or_debit" class="form-select">
                <option value="credit">Credit</option>
                <option value="debit">Debit</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Type Title</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
