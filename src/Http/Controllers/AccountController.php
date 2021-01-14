<?php

namespace Aalcala\Ledger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Aalcala\Ledger\Account;

class AccountController extends Controller
{

    public function show(Request $request, Account $account) 
    {
        return view('ledger::accounts.show', compact('account'));
    }

    public function create(Request $request) {
        $account = Account::create([
            'name' => $request->input('name'),
            'account_type' => $request->input('account_type'),
        ]);

        return redirect($request->headers->get('referer'));
    }
}
