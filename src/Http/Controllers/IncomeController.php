<?php

namespace Aalcala\Ledger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Aalcala\Ledger\Entry;
use Aalcala\Ledger\Account;

class IncomeController extends Controller
{

    public function index()
    {
        $entries = Entry::all();
        return view('ledger::income.index', compact('entries'));
    }

    public function create()
    {
        $incomeAccounts = Account::all();
        return view('ledger::income.create', compact('incomeAccounts'));
    }

    public function store(Request $request)
    {
        Entry::create([
            'date' => $request->date,
            'amount' => $request->amount * 100,
            'description' => $request->description,
            'debit_account_id' => $request->debit_account_id,
            'credit_account_id' => $request->credit_account_id,
        ]);
        return back()->with('success', 'Income entry created.');
    }

    public function edit(Entry $income)
    {
        return view('ledger::income.edit', compact('income'));
    }

    public function update(Request $request, Entry $income)
    {   
        $income->date = $request->date;
        $income->amount = $request->amount * 100;
        $income->description = $request->description;
        $income->debit_account_id = $request->debit_account_id;
        $income->credit_account_id = $request->credit_account_id;
        $income->save();
        return back()->with('success', 'Income entry updated.');
    }

    public function destroy(Entry $income)
    {
        $income->delete();
        return back()->with('Income entry deleted.');
    }
}
