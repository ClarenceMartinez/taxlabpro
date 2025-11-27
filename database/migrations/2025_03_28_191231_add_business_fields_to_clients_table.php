<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            // Ejemplo de columnas; ajusta tipos y longitudes según requieras

            $table->string('type_of_business')->nullable();
            $table->boolean('federal_contractor')->default(false);
            $table->integer('type_of_entity')->nullable(); // O podrías usar enum
            $table->date('date_established')->nullable();
            $table->string('business_website')->nullable();
            $table->unsignedInteger('total_number_of_employees')->nullable();
            $table->decimal('average_gross_monthly_payroll', 15, 2)->nullable();
            $table->string('frequency_tax_deposits')->nullable();
            $table->decimal('cash_on_hand', 15, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'type_of_business',
                'federal_contractor',
                'type_of_entity',
                'date_established',
                'business_website',
                'total_number_of_employees',
                'average_gross_monthly_payroll',
                'frequency_tax_deposits',
                'cash_on_hand',
            ]);
        });
    }
};
