<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    //
    protected $table = "ledger_entries";

    protected $fillable = ['entry_date', 'amount', 'description', 'debit_account_id', 'credit_account_id'];

}
