<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('foreign_properties', function (Blueprint $table) {
            $table->id();
            
            // Relación con la tabla clients
            $table->unsignedBigInteger('client_id')->index();
            // O bien: $table->foreignId('client_id')->constrained()->index();

            // Columnas según tu formulario/tabla
            // Por ejemplo, descripción, ubicación, valor
            $table->text('description_location_value')->nullable();

            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('client_id')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foreign_properties');
    }
};
