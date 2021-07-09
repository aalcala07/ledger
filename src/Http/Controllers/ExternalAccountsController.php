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
        $accountsByType = [];

        foreach (ExternalAccount::ACCOUNT_TYPES as $accountType) {
            $accountsByType[$accountType] = [];
        }

        foreach ($externalAccounts as $externalAccount) {
            $accountsByType[$externalAccount->account_type][] = $externalAccount;
        }

        // dd($externalAccounts->first());
        return view('ledger::externalAccounts.index', compact('accountsByType'));
    }

    public function create()
    {
        $accountTypes = ExternalAccount::ACCOUNT_TYPES;
        return view('ledger::externalAccounts.create', compact('accountTypes'));
    }

    public function store(Request $request)
    {
        ExternalAccount::create([
            'name' => $request->name,
            'account_type' => $request->account_type,
            'code' => ExternalAccount::getCodeFromName($request->name),
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('ledger.externalAccounts.index')->with('success', 'External account created.');
    }

    public function edit(ExternalAccount $externalAccount)
    {
        $accountTypes = ExternalAccount::ACCOUNT_TYPES;
        return view('ledger::externalAccounts.edit', compact('externalAccount', 'accountTypes'));
    }

    public function update(Request $request, ExternalAccount $externalAccount)
    {
        $externalAccount->name = $request->name;
        $externalAccount->account_type = $request->account_type;
        $externalAccount->code = $request->code;
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
