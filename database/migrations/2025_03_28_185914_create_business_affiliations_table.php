<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_affiliations', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla clients
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade'); // elimina en cascada si se borra el cliente

            $table->string('business_name')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('ein')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_affiliations');
    }
};
