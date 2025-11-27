<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('intangible_assets', function (Blueprint $table) {
            $table->id();
            
            // Relación con la tabla clients
            $table->unsignedBigInteger('client_id')->index();
            // O bien: $table->foreignId('client_id')->constrained()->index();

            // Columnas basadas en tu formulario/tabla
            $table->string('description')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('current_value', 15, 2)->nullable();

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
        Schema::dropIfExists('intangible_assets');
    }
};
