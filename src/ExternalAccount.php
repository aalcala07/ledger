<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;

class ExternalAccount extends Model
{
    const ACCOUNT_TYPES = ['cash', 'debt', 'investment'];
    
    protected $table = "ledger_external_accounts";

    protected $fillable = ['name', 'account_type', 'code', 'user_id'];

    protected $appends = ['balance'];

    public function balances()
    {
        return $this->hasMany('Aalcala\Ledger\ExternalAccountBalance');
    }

    public function getBalanceAttribute()
    {
        return count($this->balances) ? $this->balances()->orderBy('created_at', 'desc')->first()->balance : 0;
    }

    public static function getCodeFromName($name)
    {
        $code = str_replace(' ', '_', $name);
        $code = str_replace("'", '', $code);
        return strtolower($code);
    }
}
