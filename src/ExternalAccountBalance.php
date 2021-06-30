<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;

class ExternalAccountBalance extends Model
{
    protected $table = "ledger_external_account_balances";

    protected $fillable = ['balance'];

    public function externalAccount()
    {
        return $this->belongsTo('Aalcala\Ledger\ExternalAccount');
    }
}
