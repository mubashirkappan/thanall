@extends('welcome')

@section('title','entry')
@section('style')
.btn-primary {
    color:black;
    background-color: #00b3db;
    border-color: #357ebd;
    margin: 0;
    position: absolute;
    top: 93%;
    left:45%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open>.dropdown-toggle.btn-primary {
    color: #fff;
    background-color: ;
    border-color: #285e8e;
}

@endsection
@section('content')
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 card m-5">

            <form action="{{ route('entry.save') }}" class="m-5" method="post">
                @csrf
                <label for="entryDate">Date
                </label>
                <input type="date" name="entryDate" id="entryDate" class="form-control" >
            <br>
            <label for="debit">Debit
            </label>
            <input type="number" style="background-color:rgba(255, 0, 0, 0.3)" name="debit" id="debit" class="form-control" >
            <br>
            <label for="credit">Credit
            </label>
            <input type="number" name="credit" id="credit" class="form-control" style="background-color:rgba(0, 255, 0, 0.3);">
            <br>
            <label for="description">Description
            </label>
            <input type="text" name="description" id="description" class="form-control" >
            <br>
            <input type="hidden" name="id" value="{{ $userid }}">
            <input type="submit" value="submit" class="btn btn-primary sm" >
            </form>

        </div>
    </div>

@endsection

