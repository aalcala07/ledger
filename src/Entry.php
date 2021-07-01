<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    //
    protected $table = "ledger_entries";

    protected $fillable = ['date', 'description', 'user_id'];

}
