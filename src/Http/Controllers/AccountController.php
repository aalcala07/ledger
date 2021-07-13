<?php

namespace Aalcala\Ledger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Aalcala\Ledger\Account;

class AccountController extends Controller
{

    public function index()
    {
        $accounts = Account::where('user_id', 1)->get();
        $accountsByType = [];

        foreach (Account::ACCOUNT_TYPES as $accountType) {
            $accountsByType[$accountType] = [];
        }

        foreach ($accounts as $account) {
            $accountsByType[$account->account_type][] = $account;
        }

        return view('ledger::accounts.index', compact('accountsByType'));
    }

    public function show(Request $request, Account $account) 
    {
        return view('ledger::accounts.show', compact('account'));
    }

    public function create()
    {
        $accountTypes = Account::ACCOUNT_TYPES;
        return view('ledger::accounts.create', compact('accountTypes'));
    }

    public function store(Request $request) 
    {
        $account = Account::create([
            'name' => $request->input('name'),
            'account_type' => $request->input('account_type'),
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('ledger.accounts.index')->with('success', 'Account created.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('ledger.accounts.index')->with('success', 'Account deleted.');
    }

}
