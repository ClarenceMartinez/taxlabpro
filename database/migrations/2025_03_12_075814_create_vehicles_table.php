<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->enum('primary_vehicle_for', ['taxpayer', 'spouse', 'neither'])->default('neither');
            $table->string('year')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('vin')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('license')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('current_value', 15, 2)->nullable();
            $table->decimal('current_loan_balance', 15, 2)->nullable();
            $table->decimal('monthly_payment', 15, 2)->nullable();
            $table->date('date_of_final_payment')->nullable();
            $table->string('lender_name')->nullable();
            $table->string('lender_address')->nullable();
            $table->string('lender_city_state_zip')->nullable();
            $table->string('lender_phone')->nullable();
            // $table->enum('ownership_status', ['loan_own', 'lease'])->default('loan_own');
            $table->boolean('is_loan')->default(false);
            $table->boolean('is_lease')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
