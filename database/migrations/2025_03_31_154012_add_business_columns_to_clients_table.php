<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('business_name')->nullable()->after('type_of_business');
            $table->string('business_address')->nullable()->after('business_name');
            $table->string('business_email_address')->nullable()->after('business_address');
            $table->string('business_phone')->nullable()->after('business_email_address');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'business_name',
                'business_address',
                'business_email_address',
                'business_phone',
            ]);
        });
    }
};
