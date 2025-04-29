<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\PaymentMethod;
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
