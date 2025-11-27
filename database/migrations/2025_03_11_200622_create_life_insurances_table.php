<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('life_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('policy_number')->nullable();
            $table->string('policy_owner')->nullable();
            $table->decimal('current_cash_value', 15, 2)->nullable();
            $table->decimal('outstanding_loan_balance', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('life_insurances');
    }
};
