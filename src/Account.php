<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    const ACCOUNT_TYPES = ['dividend', 'expense', 'asset', 'liability', 'owners_equity', 'revenue'];
    
    protected $table = "ledger_accounts";

    protected $fillable = ['name', 'account_type', 'parent_account_id', 'user_id'];

    protected $appends = ['account_type_human', 'is_debit'];

    public function getAccountTypeHumanAttribute()
    {
        if ($this->account_type === 'owners_equity') {
            return "Owner's Equity";
        }
        return ucwords(str_replace('_', ' ', $this->account_type));
    }

    public function getIsDebitAttribute()
    {
        return in_array($this->account_type, ['dividend', 'expense', 'asset']);
    }

    public function debits()
    {
        return $this->hasMany('\Aalcala\Ledger\EntryDebit', 'account_id');
    }

    public function credits()
    {
        return $this->hasMany('\Aalcala\Ledger\EntryCredit', 'account_id');
    }

    public function parent()
    {
        return $this->belongsToOne(static::class, 'parent_account_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_account_id');
    }
}
