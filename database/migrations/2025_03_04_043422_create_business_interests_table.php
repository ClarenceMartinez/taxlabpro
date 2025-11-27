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
        

        Schema::create('business_interests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('business_name')->nullable();
            $table->string('business_address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('type')->nullable(); // Tipo de negocio
            $table->decimal('ownership', 5, 2)->nullable(); // % de propiedad
            $table->string('title')->nullable();
            $table->string('ein')->nullable(); // Número de Identificación del Empleador
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_interests');
    }
};
