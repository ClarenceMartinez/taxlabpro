<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {    
        Schema::table('clients', function (Blueprint $table) {
            $table->decimal('deal', 10, 2)->nullable()->after('slug');
            $table->decimal('deal_pay', 10, 2)->nullable()->after('deal');
            $table->decimal('owed', 10, 2)->nullable()->after('deal_pay');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['deal', 'deal_pay', 'owed']);
        });
    }
};
