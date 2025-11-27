<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('company_services', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla companies
            $table->unsignedBigInteger('company_id')->index();
            // o bien: $table->foreignId('company_id')->constrained()->index();

            // Ejemplo de columnas
            $table->string('service_name');
            $table->text('description')->nullable();

            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('company_id')
                  ->references('id')
                  ->on('company')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_services');
    }
};
