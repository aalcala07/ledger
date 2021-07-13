<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    //
    protected $table = "ledger_entries";

    protected $fillable = ['date', 'description', 'user_id'];

    public function debits()
    {
        return $this->hasMany('\Aalcala\Ledger\EntryDebit', 'entry_id');
    }

    public function credits()
    {
        return $this->hasMany('\Aalcala\Ledger\EntryCredit', 'entry_id');
    }

}
