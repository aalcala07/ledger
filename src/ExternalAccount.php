<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;

class ExternalAccount extends Model
{
    protected $table = "ledger_external_accounts";

    protected $fillable = ['name', 'user_id'];

    protected $appends = ['balance'];

    public function balances()
    {
        return $this->hasMany('Aalcala\Ledger\ExternalAccountBalance');
    }

    public function getBalanceAttribute()
    {
        return count($this->balances) ? $this->balances()->orderBy('created_at', 'desc')->first()->balance : 0;
    }
}
