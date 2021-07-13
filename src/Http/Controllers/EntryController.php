<?php

namespace Aalcala\Ledger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Aalcala\Ledger\Entry;
use Aalcala\Ledger\Account;

class EntryController extends Controller
{
    public function index()
    {
        $entries = Entry::where('user_id', auth()->user()->id)->with('debits', 'credits', 'debits.account', 'credits.account')->get();
        return view('ledger::entries.index', compact('entries'));
    }

    public function show(Entry $entry)
    {
        return view('ledger::entries.show', compact('entry'));
    }

    public function create()
    {
        $accounts = Account::where('user_id', auth()->user()->id)->get();
        return view('ledger::entries.create', compact('accounts'));
    }

    public function store(Request $request)
    {

        $debits = $this->getDebitsCredits($request->debits);
        $credits = $this->getDebitsCredits($request->credits);

        if (empty($debits) && empty($credits)) {
            return back()->with('error', 'Debits and credits are required.')->withInput();
        }

        if (empty($debits) || empty($credits)) {
            return back()->with('error', 'Debits and credits do not match.')->withInput();
        }

        $totalDebit = 0;
        
        foreach ($debits as $debit) {
            $totalDebit += $debit['amount'];
        }

        $totalCredit = 0;

        foreach ($credits as $credit) {
            $totalCredit += $credit['amount'];
        }

        if ($totalDebit !== $totalCredit) {
            return back()->with('error', 'Debits and credits do not match.')->withInput();
        }
        
        $entry = Entry::create([
            'date' => $request->date,
            'description' => $request->description, 
            'user_id' => auth()->user()->id
        ]);

        $entry->debits()->createMany($debits);
        $entry->credits()->createMany($credits);

        // foreach ($debits as $debit) {
        //     // $entry->debits()->create($debit);
        //     $debit['entry_id'] = $entry->id;
        //     \Aalcala\Ledger\EntryDebit::create($debit);
        // }

        // foreach ($credits as $credit) {
        //     // $entry->credits()->create($credit);
        //     $credit['entry_id'] = $entry->id;
        //     \Aalcala\Ledger\EntryCredit::create($credit);
        // }

        return redirect()->route('ledger.entries.index')->with('success', 'Entry created.');
    }

    public function edit(Entry $entry)
    {
        return view('ledger::entries.edit', compact('entry'));
    }

    public function update(Request $request, Entry $entry)
    {
        $entry->date = $request->date;
        $entry->description = $request->description;

        // TODO: Replace debits and credits
    }

    public function destroy(Entry $entry)
    {
        $entry->delete();
        return redirect()->route('ledger.entries.index')->with('success', 'Entry deleted.');
    }

    private function getDebitsCredits($debitsCredits)
    {
        $items = [];

        foreach ($debitsCredits as $debitCredit) {
            if ($debitCredit['amount'] && $debitCredit['amount'] > 0.01 && $debitCredit['account_id']) {
                $items[] = [
                    'amount' => floatval($debitCredit['amount']) * 100,
                    'account_id' => $debitCredit['account_id']
                ];
            }
        }

        return $items;
    }

}
