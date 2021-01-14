<?php

namespace Aalcala\Ledger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Aalcala\Ledger\Account;

class DashboardController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('ledger::dashboard', compact('accounts'));
    }
}
