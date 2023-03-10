<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // $users=User::all();
        $auth=Auth::attempt(['email'=>request('email'),'password'=>request('password')]);
        if($auth){
            return to_route('user.show')->with('message','login success');
        }
        else{
            return to_route('home')->with('message','invalid credentils');
        }
    }

    public function create()
    {
        return view('user_create');
    }

    public function store()
    {
        $input=['f_name'=>request('firstName'),
        'l_name'=>request('lastName'),
        'gender'=>request('gender'),
        'adress'=>request('address'),
        'email'=>request('emailAddress'),
        'phone'=>request('phoneNumber'),
        'job'=>request('job'),
        'password'=>bcrypt(request('password')),
    ];
    User::create($input);
    if(request('null')==1){
        return to_route('user.show')->with('message','user added successfully');
    }
    else{
        return to_route('home',)->with('messsage','success');
    }
    }
    public function show()
    {
        $users=User::all();
        return view('users_list',compact('users'));
    }
    public function edit($id)
    {
        $user=User::find($id);
        if($user){
            return response()->json($user);
        }
        else{
            dd('ok');
        }

    }
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        if($user){
            $input=['f_name'=>request('firstName'),
            'l_name'=>request('lastName'),
            'gender'=>request('gender'),
            'adress'=>request('address'),
            'email'=>request('emailAddress'),
            'phone'=>request('phoneNumber'),
            'job'=>request('job'),
            'password'=>bcrypt(request('password')),
            ];
            $user->update($input);
        return to_route('user.show')->with('message','user updated successfully');
        }
    }
    public function delete($id)
    {
        User::find($id)->delete();
        return to_route('user.show')->with('message','user deleted successfully');

    }
    public function view($id){
        return view('user_view');
    }
    public function entry($id){
        $userid=$id;
        return view('user_data_entry',compact('userid'));
    }

}
