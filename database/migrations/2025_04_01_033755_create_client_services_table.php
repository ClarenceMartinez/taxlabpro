<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('client_services', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla clients
            $table->unsignedBigInteger('client_id')->index();
            // Agregar otros campos para el servicio
            $table->string('service_id')->default('Service'); // Nombre del servicio

            $table->timestamps();

            // Definir la clave foránea para client_id
            $table->foreign('client_id')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_services');
    }
};
