<?php

namespace Aalcala\Ledger\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Aalcala\Ledger\Account;
use Aalcala\Ledger\ExternalAccount;
use Aalcala\Ledger\CustomFunction;

class DashboardController extends Controller
{

    public $cards;

    public function index()
    {
        $externalAccounts = ExternalAccount::where('user_id', auth()->user()->id)->get();
        // $accounts = Account::all();
        $this->cards = collect([
            $this->getExternalAccountsCard($externalAccounts),
        ]);

        $this->addCustomFunctionCards();

        $this->cards->push(
            [
                'title' => 'Income',
                'stat' => '$15,984.09',
                'options' => [
                    [
                        'label' => 'Manage Income',
                        'url' => route('ledger.income.index')
                    ],
                    [
                        'label' => 'Create Income Entry',
                        'url' => route('ledger.income.create')
                    ]
                ],
                'action' => [
                    'label' => 'Add Income',
                    'type' => 'accounts.addEntry',
                    'account_type' => 'income'
                ]
            ],
            [
                'title' => 'Expenses',
                'stat' => '$15,984.09',
                'options' => [
                    [
                        'label' => 'Manage Expenses'
                    ]
                ],
                'action' => [
                    'label' => 'Add Expense',
                    'type' => 'accounts.addEntry',
                    'account_type' => 'income'
                ]
            ],
            [
                'title' => 'Profit',
                'stat' => '$15,984.09'
            ],
            [
                'title' => 'Income Tax',
                'stat' => '$1,984.09'
            ]
        );

        // dd($cards);
        $cards = $this->cards;

        return view('ledger::dashboard', compact('cards'));
    }

    protected function getExternalAccountsCard($externalAccounts)
    {
        $rows = [];
        $cash = 0;
        $credit = 0;
        $total = 0;

        foreach ($externalAccounts as $account) {
            if ($account->balance < 0) {
                $credit += $account->balance;
            } else {
                $cash += $account->balance;
            }
            $total += $account->balance;
        }
        
        $rows[] = ['Cash', '$'.number_format($cash/100, 2)];
        $rows[] = ['Credit', '$'.number_format($credit/100, 2)];
        $rows[] = ['Total', '$'.number_format($total/100, 2)];

        return [
            'title' => 'External Accounts',
            'options' => [
                [
                    'label' => 'Manage External Accounts',
                    'url' => route('ledger.externalAccounts.index')
                ]
            ],
            'table' => [
                'rows' => $rows
            ]
        ];
    }

    protected function addCustomFunctionCards()
    {
        $customFunctions = CustomFunction::where('user_id', auth()->user()->id)->get();

        foreach ($customFunctions as $customFunction) {
            $stat = $customFunction->evaluate();
            $this->cards->push([
                'title' => $customFunction->name,
                'stat' =>  $stat !== null ? "$" . number_format($stat, 2) : "error"
            ]);
        }
    }
}
