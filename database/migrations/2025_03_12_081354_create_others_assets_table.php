<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('other_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->enum('type', ['tangible', 'intangible'])->default('tangible');
            $table->string('description')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('county')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('current_value', 15, 2)->nullable();
            $table->decimal('current_loan_balance', 15, 2)->nullable();
            $table->decimal('monthly_payment', 15, 2)->nullable();
            $table->date('date_of_final_payment')->nullable();
            $table->string('lender')->nullable();
            $table->string('lender_address')->nullable();
            $table->string('lender_city_state_zip')->nullable();
            $table->string('lender_phone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_assets');
    }
};
