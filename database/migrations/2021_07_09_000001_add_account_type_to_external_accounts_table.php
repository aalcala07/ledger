<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountTypeToExternalAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ledger_external_accounts', function (Blueprint $table) {
            $table->enum('account_type', ['cash', 'debt', 'investment'])->default('cash')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ledger_external_accounts', function (Blueprint $table) {
            $table->dropColumn('account_type');
        });
    }
}
