<?php

namespace Aalcala\Ledger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Aalcala\Ledger\Entry;

class EntryController extends Controller
{
    public function create(Request $request)
    {
        $entry = Entry::create([
            'date' => $request->date,
            'amount' => $request->amount,
            'description' => $request->description,
            'debit_account_id' => $request->debit_account_id,
            'credit_account_id' => $request->credit_account_id
        ]);

        return redirect($request->headers->get('referer'));
    }
}
