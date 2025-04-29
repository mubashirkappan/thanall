<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            $methods = PaymentMethod::all();
        } else {
            $methods = PaymentMethod::where('user_id', auth()->user()->id)->get();
        }

        return view('payment_methods.index', compact('methods'));
    }

    public function create()
    {
        $users = User::all();

        return view('payment_methods.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'balance' => 'required',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if (! isset($request->user_id)) {
            $request->user_id = auth()->user()->id;
        }
        PaymentMethod::create([
            'title' => $request->title,
            'balance' => $request->balance,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('payment.index')->with('message', 'Payment method created successfully.');
    }

    public function edit($id)
    {
        $users = User::all();
        $paymentMethod = PaymentMethod::findOrFail($id);

        return view('payment_methods.edit', compact('paymentMethod', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'balance' => 'required',
            'user_id' => 'nullable|exists:users,id',
        ]);
        if (! isset($request->user_id)) {
            $request->user_id = auth()->user()->id;
        }
        $method = PaymentMethod::findOrFail($id);
        $method->update([
            'title' => $request->title,
            'balance' => $request->balance,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('payment.index')->with('success', 'Payment method updated successfully.');
    }

    public function delete($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->delete();

        return redirect()->route('payment.index')->with('success', 'Payment method deleted successfully.');
    }
}
