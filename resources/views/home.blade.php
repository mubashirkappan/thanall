@extends('welcome')
@section('title','home')
@section('content')
<div class="row" style="position: relative;top:230px">
    <div class="col-7">
        <center>
            <h1 style="font-family:verdana">thanal palisha rahitha bank</h1>
            <img src="/img/download.png " alt="" style="position: relative;top:20px;height: 350px;width: 350px;">
        </center>
    </div>
    <div class="col-3" style="position: relative;top:60px">
        <center><h3>login please</h3></center>
        <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
