<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Aalcala\Ledger\Http\Controllers')->group(function () {
    Route::prefix(config('ledger.path'))->as('ledger.')->middleware(config('ledger.middleware'))->group(function() {

        Route::get('/', function() {
            return redirect()->route('ledger.dashboard');
        });

        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::prefix('accounts')->as('accounts.')->group( function() {
            route::get('{account}', 'AccountController@show')->name('show');
            route::post('/', 'AccountController@create')->name('create');
        });

        Route::prefix('entries')->as('entries.')->group( function() {
            route::post('/', 'EntryController@create')->name('create');
        });
    });
});