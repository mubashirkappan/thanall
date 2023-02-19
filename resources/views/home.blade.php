@extends('welcome')
@section('title','home')
@section('content')
<div class="row" style="position: relative;top:230px">
    <div class="col-7">
        <center>
            {{--  <h1 style="font-family:verdana">thanal palisha rahitha bank</h1>  --}}
            <img src="/img/download.png " alt="" style="position: relative;top:20px;height: 250px;width: 250px;">
        </center>
    </div>
    <div class="col-2" style="position: relative;top:60px">
        <center><h3>login please</h3></center>
        @if(session()->has('message'))
                <p style="color: red">
                    {{ session()->get('message') }}
                </p>
        @endif
        <div class="form-group">
        <form  method="POST" action="{{ route('user.list') }}">
            @csrf
              <label for="exampleInputEmail1">Email address</label>
              <input autocomplete="off" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary ml-5 mt-3" style="position: relative;left: 60px;">Submit</button>
        </form>
        <a href="{{ route('user.create') }}" class="" style="position: relative;left: 140px;top: 10px; color:aqua">don't have an account</a>
    </div>
</div>
@endsection
