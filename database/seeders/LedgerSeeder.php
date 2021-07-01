<?php
namespace Aalcala\Ledger\Database\Seeders;

use Illuminate\Database\Seeder;
use Aalcala\Ledger\Account;

class LedgerSeeder extends Seeder
{
    const USER_ID = 1;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $accountsReceivable = Account::create([
            'name' => 'Accounts Receivable',
            'account_type' => 'asset',
            'user_id' => self::USER_ID
        ]);

        $cash = Account::create([
            'name' => 'Cash',
            'account_type' => 'asset',
            'user_id' => self::USER_ID
        ]);

        $inventory = Account::create([
            'name' => 'Inventory',
            'account_type' => 'asset',
            'user_id' => self::USER_ID
        ]);

        $accountsPayable = Account::create([
            'name' => 'Accounts Receivable',
            'account_type' => 'liability',
            'user_id' => self::USER_ID
        ]);

        $notesPayable = Account::create([
            'name' => 'Notes Payable',
            'account_type' => 'liability',
            'user_id' => self::USER_ID
        ]);

        $incomeTaxExpense = Account::create([
            'name' => 'Income Tax Expense',
            'account_type' => 'expense',
            'user_id' => self::USER_ID
        ]);

        $badDebts = Account::create([
            'name' => 'Bad Debts Expense',
            'account_type' => 'expense',
            'user_id' => self::USER_ID
        ]);

        $allowanceForDoubtfulAccounts = Account::create([
            'name' => 'Allowance for Doubtful Accounts',
            'account_type' => 'asset',
            'user_id' => self::USER_ID
        ]);

        $retainedEarnings = Account::create([
            'name' => 'Retained Earnings',
            'account_type' => 'owners_equity',
            'user_id' => self::USER_ID
        ]);

        $consultingRevenue = Account::create([
            'name' => 'Consulting Revenue',
            'account_type' => 'revenue',
            'user_id' => self::USER_ID
        ]);

        $consultingRevenue = Account::create([
            'name' => 'Dividends Paid',
            'account_type' => 'dividends',
            'user_id' => self::USER_ID
        ]);
        
    }
}