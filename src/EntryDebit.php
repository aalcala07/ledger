<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;

class EntryDebit extends Model
{
    protected $table = "ledger_entry_debits";

    protected $fillable = ['amount', 'entry_id', 'account_id'];

    public function entry()
    {
        return $this->belongsTo('\Aalcala\Ledger\Entry');
    }

    public function account()
    {
        return $this->hasOne('\Aalcala\Ledger\Account', 'id', 'account_id');
    }

}
