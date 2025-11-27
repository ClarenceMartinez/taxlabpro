<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firm_ein')->nullable()->after('password');
            $table->string('caf_no')->nullable()->after('firm_ein');
            $table->string('ptin')->nullable()->after('caf_no');
            $table->string('ctec')->nullable()->after('ptin');
            $table->string('ny_tprin')->nullable()->after('ctec');
            $table->string('designation')->nullable()->after('ny_tprin');
            $table->string('licensing_jurisdiction')->nullable()->after('designation');
            $table->string('license_no')->nullable()->after('licensing_jurisdiction');
            $table->string('a2a')->nullable()->after('license_no');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'firm_ein',
                'caf_no',
                'ptin',
                'ctec',
                'ny_tprin',
                'designation',
                'licensing_jurisdiction',
                'license_no',
                'a2a',
            ]);
        });
    }
}
