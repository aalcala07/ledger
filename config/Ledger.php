<?php

return [
    //
    'path' => env('LEDGER_PATH_NAME', 'ledger'),

    'db' => [
        'prefix' => env('LEDGER_DB_PREFIX', 'ledger_'),
    ],

    'user' => Illuminate\Foundation\Auth\User::class,

    'middleware' => [
        'web',
        'auth',
    ],

];