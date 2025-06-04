<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\PaymentMethod;
use App\Models\Type;
use App\Models\User;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'entryDate' => 'required|date',
            'debit' => 'nullable|numeric|exclude_if:credit,!=,null',
            'credit' => 'nullable|numeric|exclude_if:debit,!=,null',
            'description' => 'nullable|string',
            'payment_method_id' => 'required',
        ], [
            'debit.exclude_if' => 'You cannot provide both debit and credit at the same time.',
            'credit.exclude_if' => 'You cannot provide both debit and credit at the same time.',
        ]);
        $id = request('id');
        $input = [
            'entry_date' => request('entryDate'),
            'debit' => request('debit'),
            'credit' => request('credit'),
            'description' => request('description'),
            'user_id' => request('id'),
            'payment_method_id' => request('payment_method_id'),
            'type_id' => request('type_id'),
        ];
        $paymentMethod = PaymentMethod::findOrFail($input['payment_method_id']);
        if ($request->debit) {
            // Debit reduces the balance
            $paymentMethod->balance -= $request->debit;
        } elseif ($request->credit) {
            // Credit increases the balance
            $paymentMethod->balance += $request->credit;
        }

        // Save the updated payment method balance
        $paymentMethod->save();
        $input['balance'] = $paymentMethod->balance;
        $result = Entry::create($input);

        return to_route('user.view', ['id' => $id])->with('message');
    }

    public function edit($id)
    {
        $entry = Entry::findOrFail($id);
        $userid = $id;
        if (auth()->user()->is_admin) {
            $types = Type::all();
            $paymentMethods = PaymentMethod::all();
        } else {
            $types = Type::where('user_id', auth()->user()->id)->get();
            $paymentMethods = PaymentMethod::where('user_id', auth()->user()->id)->get();
        }
        $users = User::all();
        return view('entries.edit', compact('entry', 'paymentMethods', 'types', 'users'));
    }

    public function destroy($id)
    {
        $entry = Entry::findOrFail($id);
        $paymentMethod = PaymentMethod::findOrFail($entry->payment_method_id);
        if ($entry->debit) {
            // Debit reduces the balance
            $paymentMethod->balance += $entry->debit;
        } elseif ($entry->credit) {
            // Credit increases the balance
            $paymentMethod->balance -= $entry->credit;
        }

        // Save the updated payment method balance
        $paymentMethod->save();
        $entry->delete();

        return redirect()->back()->with('success', 'Entry deleted successfully.');
    }
    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'entry_date' => 'required|date',
            'debit' => 'nullable|numeric',
            'credit' => 'nullable|numeric',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'description' => 'nullable|string',
            'type_id' => 'required|exists:types,id',
        ]);

        // Save the updated payment method balance
        $entry = Entry::findOrFail($id);
        $paymentMethod = PaymentMethod::findOrFail($input['payment_method_id']);
        if ($request->debit) {
            // Debit reduces the balance
            $paymentMethod->balance = $paymentMethod->balance - $request->debit + $entry->debit;
        } elseif ($request->credit) {
            // Credit increases the balance
            $paymentMethod->balance = $paymentMethod->balance + $request->credit - $entry->credit;
        }
        $paymentMethod->save();
        $input['balance'] = $paymentMethod->balance;
        $entry->update($input);

        return redirect()->route('user.view', $entry->user_id)->with('success', 'Entry updated successfully.');
    }
}
