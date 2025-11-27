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
        Schema::create('monthly_financials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->enum('accounting_method', ['cash', 'accrual'])->default('cash');
            // Periodo
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();

            // Ingresos
            $table->decimal('gross_receipts', 12, 2)->default(0);
            $table->decimal('gross_rental_income', 12, 2)->default(0);
            $table->decimal('interest', 12, 2)->default(0);
            $table->decimal('dividends', 12, 2)->default(0);
            $table->decimal('cash_receipts', 12, 2)->default(0);

            // Egresos
            $table->decimal('materials_purchased', 12, 2)->default(0);
            $table->decimal('inventory_purchased', 12, 2)->default(0);
            $table->decimal('wages_salaries', 12, 2)->default(0);
            $table->decimal('rent', 12, 2)->default(0);
            $table->decimal('supplies', 12, 2)->default(0);
            $table->decimal('utilities', 12, 2)->default(0);
            $table->decimal('vehicle_gas_oil', 12, 2)->default(0);
            $table->decimal('repairs_maintenance', 12, 2)->default(0);
            $table->decimal('insurance', 12, 2)->default(0);
            $table->decimal('current_taxes', 12, 2)->default(0);

            // Totales
            $table->decimal('total_income', 12, 2)->default(0);
            $table->decimal('total_expense', 12, 2)->default(0);
            $table->decimal('net_balance', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_financials');
    }
};
