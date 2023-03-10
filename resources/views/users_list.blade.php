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
                <a href="#" class="btn btn-primary mb-3" id="add_user">add user</a>
            </div>
        </div>
      <table class="table table-striped mr-2">
        <thead>
            @if(session()->has('message'))
                <h3 style="color: green">
                    {{ session()->get('message') }}
                </h3>
        @endif
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
                    <a href="{{ route('user.entry',$user->id)  }}" id="entryUser">Entry</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('user.view',$user->id)  }}" id="viewUser">View</a>&nbsp;&nbsp;&nbsp;
                    <a edit-url="{{route('user.edit',$user->id)  }}" href="#" update-url="{{route('user.update',$user->id)  }}" id="edit">Edit</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('user.delete',$user->id) }}" id="delete">Delete</a>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
  <div class="col-1"></div>
    </div>
    </div>

    <input id="qr-create-menu" type="checkbox">
    <ul class="drawer">
                    <div class="card-body p-4 p-md-3">
                      <center>
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                      </center>
                      <form method="POST" action="{{ route('user.save')  }}" id="addUser">
                        @csrf
                        <div class="row">
                          <div class="col-md-6 mb-4">
                            <div class="form-outline">
                              <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" />
                              <label class="form-label" for="firstName">First Name</label>
                            </div>

                          </div>
                          <div class="col-md-6 mb-4">

                            <div class="form-outline">
                              <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" />
                              <label class="form-label" for="lastName">Last Name</label>
                            </div>

                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">

                                <select class="form-control" name="gender">
                                    <option>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                  </select>

                            </div>
                            <div class="col-md-6 mb-4 pb-2">

                              <div class="form-outline">
                                <input type="text" id="address" name="address" class="form-control form-control-lg" />
                                <label class="form-label" for="address">Address</label>
                              </div>

                            </div>
                          </div>
                        <div class="row">
                          <div class="col-md-6 mb-4 pb-2">

                            <div class="form-outline">
                              <input type="email" id="emailAddress" name="emailAddress" class="form-control form-control-lg" />
                              <label class="form-label" for="emailAddress">Email</label>
                            </div>

                          </div>
                          <div class="col-md-6 mb-4 pb-2">

                            <div class="form-outline">
                              <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-control-lg" />
                              <label class="form-label" for="phoneNumber">Phone Number</label>
                            </div>

                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">

                              <div class="form-outline">
                                <input type="text" id="job" name="job" class="form-control form-control-lg" />
                                <label class="form-label" for="job">Job</label>
                              </div>

                            </div>
                            <div class="col-md-6 mb-4 pb-2">

                              <div class="form-outline">
                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Password</label>
                              </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                            </div>
                            <div class="col-3">
                                <div class="mb-5 pt-1">
                                    <input type="button" value="close" class="btn btn-danger btn-sm" id="close">
                                    <input class="btn btn-primary btn-sm" type="submit" value="Submit" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="null" value="1">
                        <input type="hidden" name="id" name="userId" value="1">
                      </form>
                    </div>
    </ul>
  @endsection
@section('script')
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
