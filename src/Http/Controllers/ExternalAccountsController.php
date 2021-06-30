<?php

namespace Aalcala\Ledger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Aalcala\Ledger\ExternalAccount;

class ExternalAccountsController extends Controller
{

    public function index()
    {
        $externalAccounts = ExternalAccount::where('user_id', auth()->user()->id)->get();
        return view('ledger::externalAccounts.index', compact('externalAccounts'));
    }

    public function create()
    {
        return view('ledger::externalAccounts.create');
    }

    public function store(Request $request)
    {
        ExternalAccount::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('ledger.externalAccounts.index')->with('success', 'External account created.');
    }

    public function edit(ExternalAccount $externalAccount)
    {
        return view('ledger::externalAccounts.edit', compact('externalAccount'));
    }

    public function update(Request $request, ExternalAccount $externalAccount)
    {
        $externalAccount->name = $request->name;
        $externalAccount->save();
        $externalAccount->balances()->create([
            'balance' => $request->balance * 100
        ]);
        return back()->with('success', 'External account updated.');
    }

    public function destroy(ExternalAccount $externalAccount)
    {
        $externalAccount->delete();
        return redirect()->route('ledger.externalAccounts.index')->with('success', 'External account deleted.');
    }
}
