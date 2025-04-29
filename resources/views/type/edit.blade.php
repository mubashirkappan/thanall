@extends('welcome')

@section('title', 'Edit Type')

@section('content')
<div class="row mt-5">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card shadow p-4">
            <h4 class="mb-4 text-center">Edit Type</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('type.update', $type->id) }}">
                @csrf
                <div class="form-group mb-3">
                    <select name="user_id" class="form-select">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->f_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <select name="credit_or_debit" class="form-select">
                        <option value="credit">Credit</option>
                        <option value="debit">Debit</option>
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="name">Type Name</label>
                    <input type="text" class="form-control" name="title" id="name" value="{{ old('title', $type->title) }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('type.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
