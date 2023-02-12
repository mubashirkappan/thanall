@extends('welcome')
@section('title','list')
@section('content')
<div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <center>
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 mt-5">Users List</h3>
        </center>
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
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
            <td>Otto</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@fat</td>
            <td>@fat</td>
            <td>@fat</td>
            <td>@fat</td>
            <td>@fat</td>
            <td>@twitter</td>
          </tr>
        </tbody>
    </table>
  <div class="col-1"></div>
    </div>
    </div>
  @endsection
