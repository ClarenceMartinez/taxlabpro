<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            
            $table->string('trade_name')->nullable();
            $table->string('business_street')->nullable();
            $table->string('business_city')->nullable();
            $table->string('business_state')->nullable();
            $table->string('business_zip_code')->nullable();
            // Si "Sole proprietorship" y "Federal contractor" son checks (sí/no)
            $table->boolean('sole_proprietorship')->default(false);
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Puedes usar un array para eliminar todas a la vez
            $table->dropColumn([
                'trade_name',
                'business_street',
                'business_city',
                'business_state',
                'business_zip_code',
                'sole_proprietorship',
            ]);
        });
    }
};
