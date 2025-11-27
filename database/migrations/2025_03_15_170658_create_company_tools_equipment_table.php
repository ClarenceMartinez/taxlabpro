<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_tools_equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('description')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->decimal('current_value', 15, 2)->nullable();
            $table->decimal('current_loan_balance', 15, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('date_of_final_payment')->nullable();
            $table->string('status')->nullable();
            $table->decimal('monthly_payment', 15, 2)->nullable();
            $table->string('lender')->nullable();
            $table->string('lender_address')->nullable();
            $table->string('lender_phone')->nullable();
            $table->boolean('is_leased_or_income_generating')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_tools_equipment');
    }
};
