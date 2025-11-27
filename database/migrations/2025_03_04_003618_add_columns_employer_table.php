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
        Schema::table('employment', function (Blueprint $table) {
            $table->string('employer_year', 20)->nullable()->after('occupation');
            $table->string('employer_month', 20)->nullable()->after('employer_year');
            $table->string('does_claimed_form', 250)->nullable()->after('local_tax');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
