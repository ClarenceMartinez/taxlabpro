<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('credit_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('city')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('property_security')->nullable();
            $table->string('account_number')->nullable();
            $table->decimal('credit_limit', 15, 2)->nullable();
            $table->decimal('loan_balance', 15, 2)->nullable();
            $table->integer('employed_years')->nullable();
            $table->decimal('minimum_monthly_payment', 15, 2)->nullable();
            $table->date('statement_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_accounts');
    }
};
