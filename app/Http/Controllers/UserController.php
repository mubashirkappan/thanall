<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\PaymentMethod;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // $users=User::all();
        $auth = Auth::attempt(['email' => request('email'), 'password' => request('password')]);
        if ($auth) {
            return view('dashboard')->with('message', 'login success');
        } else {
            return to_route('home')->with('message', 'invalid credentials');
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function create()
    {
        return view('user_create');
    }

    public function store()
    {
        $input = [
            'f_name' => request('firstName'),
            'l_name' => request('lastName'),
            'gender' => request('gender'),
            'adress' => request('address'),
            'email' => request('emailAddress'),
            'phone' => request('phoneNumber'),
            'job' => request('job'),
            'password' => bcrypt(request('password')),
        ];
        User::create($input);
        $auth = Auth::attempt(['email' => request('emailAddress'), 'password' => request('password')]);
        if ($auth) {
            return view('dashboard')->with('message', 'login success');
        } else {
            return to_route('home')->with('message', 'invalid credentials');
        }
    }

    public function show()
    {
        $users = User::all();

        return view('users_list', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        } else {
            dd('ok');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $input = [
                'f_name' => request('firstName'),
                'l_name' => request('lastName'),
                'gender' => request('gender'),
                'adress' => request('address'),
                'email' => request('emailAddress'),
                'phone' => request('phoneNumber'),
                'job' => request('job'),
                'password' => bcrypt(request('password')),
            ];
            $user->update($input);

            return to_route('user.show')->with('message', 'user updated successfully');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();

        return to_route('user.show')->with('message', 'user deleted successfully');
    }

    public function view(Request $request, $id = null)
    {
        $users = User::all();
        if (auth()->user()->is_admin) {
            $paymentMethods = PaymentMethod::all();
            $category = Type::all();
        } else {
            $paymentMethods = PaymentMethod::where('user_id', auth()->user()->id)->get();
            $category = Type::where('user_id', auth()->user()->id)->get();
        }

        $query = Entry::latest();

        if ($id != null) {
            $query->where('user_id', $id);
        }

        // User filter
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('category_id')) {
            $query->where('type_id', $request->category_id);
        }

        // Payment method filter
        if ($request->filled('payment_method_id')) {
            $query->where('payment_method_id', $request->payment_method_id);
        }

        // Debit or credit filter
        if ($request->filled('debit_or_credit')) {
            if ($request->debit_or_credit == 'debit') {
                $query->whereNotNull('debit');
            } elseif ($request->debit_or_credit == 'credit') {
                $query->whereNotNull('credit');
            }
        }

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('entry_date', [$request->start_date, $request->end_date]);
        }

        // Weekly, Monthly, Yearly filter
        if ($request->filled('time_filter')) {
            if ($request->time_filter == 'weekly') {
                $query->whereBetween('entry_date', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek(),
                ]);
            } elseif ($request->time_filter == 'monthly') {
                $query->whereMonth('entry_date', Carbon::now()->month);
            } elseif ($request->time_filter == 'yearly') {
                $query->whereYear('entry_date', Carbon::now()->year);
            }
        }
        // Pagination
        $perPage = $request->get('per_page', 10);
        $entries = $query
        ->get();
        // ->paginate($perPage);
        $totals = [
            'total_debit' => $entries->sum('debit'),
            'total_credit' => $entries->sum('credit'),
        ];
        return view('user_view', compact('entries', 'id', 'users', 'paymentMethods','category','totals'));
    }

    public function entry($id = null)
    {
        $userid = $id;
        if (auth()->user()->is_admin) {
            $types = Type::all();
            $paymentMethods = PaymentMethod::all();
        } else {
            $types = Type::where('user_id', auth()->user()->id)->get();
            $paymentMethods = PaymentMethod::where('user_id', auth()->user()->id)->get();
        }
        $users = User::all();

        return view('user_data_entry', compact('userid', 'types', 'paymentMethods', 'users'));
    }
}
