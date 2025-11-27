<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('taxpayer_lawsuits_irs', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla clients
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade'); // elimina en cascada si se borra el cliente

            // Campo para describir tipos de impuesto y periodos involucrados
            $table->text('types_of_tax_and_periods')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taxpayer_lawsuits_irs');
    }
};
