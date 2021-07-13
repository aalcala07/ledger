<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Aalcala\Ledger\Http\Controllers')->group(function () {
    Route::prefix(config('ledger.path'))->as('ledger.')->middleware(config('ledger.middleware'))->group(function() {

        Route::get('/', function() {
            return redirect()->route('ledger.dashboard');
        });

        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        // Route::prefix('accounts')->as('accounts.')->group( function() {
        //     Route::
        //     route::get('{account}', 'AccountController@show')->name('show');
        //     route::post('/', 'AccountController@create')->name('create');
        // });
        
        Route::resource('accounts', 'AccountController');
        Route::resource('entries', 'EntryController');
        Route::resource('externalAccounts', 'ExternalAccountsController');
        Route::resource('income', 'IncomeController');
    });
});