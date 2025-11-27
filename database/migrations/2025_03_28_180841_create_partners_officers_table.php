<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partners_officers', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla clients
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade'); // elimina en cascada si se borra el cliente

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('title')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('social_security_number')->nullable();
            $table->string('ownership_percentage')->nullable();
            $table->string('shares_interest')->nullable();
            $table->string('annual_salary_draw')->nullable();

            // Boolean para indicar si es responsable de depositar impuestos
            $table->boolean('responsible_for_depositing_payroll_taxes')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partners_officers');
    }
};
