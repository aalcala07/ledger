<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Entry extends Model
{
    //
    protected $table = "ledger_entries";

    protected $fillable = ['date', 'description', 'user_id'];

    public $appends = ['date_short'];

    public function debits()
    {
        return $this->hasMany('\Aalcala\Ledger\EntryDebit', 'entry_id');
    }

    public function credits()
    {
        return $this->hasMany('\Aalcala\Ledger\EntryCredit', 'entry_id');
    }

    public function getDateShortAttribute()
    {
        return (new Carbon($this->date))->format('n/j');
    }

}
