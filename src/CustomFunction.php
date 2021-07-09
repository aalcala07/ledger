<?php

namespace Aalcala\Ledger;

use Illuminate\Database\Eloquent\Model;
use \Matex\Evaluator;

class CustomFunction extends Model
{
    protected $table = "ledger_custom_functions";

    protected $fillable = ['name', 'function', 'user_id'];

    // protected $appends = [];

    public function evaluate()
    {
        $function = $this->function;
        
        $externalAccounts = ExternalAccount::all();

        foreach ($externalAccounts as $externalAccount) {
            $function = str_replace("[$externalAccount->code]", $externalAccount->balance/100, $function);
        }

        $evaluator = new Evaluator();

        try {
            return $evaluator->execute($function);
        } catch (\Exception $e) {
            return null;
        }
    }
}
