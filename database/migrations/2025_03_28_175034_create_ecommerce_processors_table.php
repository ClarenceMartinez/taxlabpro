<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ecommerce_processors', function (Blueprint $table) {
            $table->id();
            // Relación con clients
            $table->foreignId('client_id')
                  ->constrained('clients') // Nombre de la tabla referenciada
                  ->onDelete('cascade');   // Elimina en cascada si se borra el cliente

            $table->string('processor_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city_state_zip')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ecommerce_processors');
    }
};
