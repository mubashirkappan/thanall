@extends('welcome')
@section('title','list')
@section('content')
<div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <center>
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 mt-5">Users List</h3>
        </center>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-1">
                <a href="" class="btn btn-primary mb-3">add user</a>
            </div>
        </div>
                <table class="table table-striped mr-2" >
        <thead>
          <tr class="" style="color:mediumpurple;background-color: black">
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Job</th>
            <th scope="col">Address</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th>{{ $user->f_name }}</th>
                <th>{{ $user->l_name }}</th>
                <th>{{ $user->gender }}</th>
                <th>{{ $user->email }}</th>
                <th>{{ $user->phone }}</th>
                <th>{{ $user->job }}</th>
                <th>{{ $user->adress }}</th>
                <th>
                    <a href="">edit</a>&nbsp;&nbsp;&nbsp;
                    <a href="">delete</a>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
  <div class="col-1"></div>
    </div>
    </div>
  @endsection
