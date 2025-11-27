<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->boolean('is_primary')->default(false);
            $table->string('street_address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('country')->nullable();
            $table->text('description')->nullable();
            $table->string('title_held')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->date('refinance_date')->nullable();
            $table->decimal('refinance_amount', 15, 2)->nullable();
            $table->decimal('current_value', 15, 2)->nullable();
            $table->decimal('loan_balance', 15, 2)->nullable();
            $table->decimal('monthly_payment', 10, 2)->nullable();
            $table->date('final_payment_date')->nullable();
            $table->string('lender_name')->nullable();
            $table->string('lender_address')->nullable();
            $table->string('lender_city_state_zip')->nullable();
            $table->string('lender_phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
