<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            $types = Type::withSum('entries as total_debit', 'debit')
           ->withSum('entries as total_credit', 'credit')->all();
        } else {
            $types = Type::withSum('entries as total_debit', 'debit')
           ->withSum('entries as total_credit', 'credit')->where('user_id', auth()->user()->id)->get();
        }
        return view('type.index', compact('types'));
    }

    public function create()
    {
        $users = User::all();

        return view('type.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request = $request->validate([
            'title' => 'required',
            'credit_or_debit' => 'required|in:credit,debit',
        ]);
        $request['user_id'] = auth()->user()->id;
        Type::create($request);

        return redirect()->route('type.index')->with('message', 'Type added successfully.');
    }

    public function edit(Type $type)
    {
        return view('type.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $request->validate(['title' => 'required','credit_or_debit'=>'required|in:credit,debit']);
        $type->update($request->only('title','credit_or_debit'));

        return redirect()->route('type.index')->with('message', 'Type updated successfully.');
    }

    public function delete(Type $type)
    {
        $type->delete();

        return redirect()->route('type.index')->with('message', 'Type deleted successfully.');
    }
}
