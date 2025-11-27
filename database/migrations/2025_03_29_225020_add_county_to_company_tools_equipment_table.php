<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('company_tools_equipment', function (Blueprint $table) {
            $table->string('county')->nullable()->after('city_state_zip');
            $table->string('lender_city_state_zip')->nullable()->after('lender_phone');
        });
    }

    public function down()
    {
        Schema::table('company_tools_equipment', function (Blueprint $table) {
            $table->dropColumn('county');
            $table->dropColumn('lender_city_state_zip');
        });
    }
};
