<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('safes', function (Blueprint $table) {
            $table->id();
            // Relación con clients
            $table->unsignedBigInteger('client_id')->index();
            
            // Otras columnas que necesites
            $table->string('contents')->nullable();
            $table->decimal('value', 10, 2)->nullable();
            
            $table->timestamps();
            
            // Si deseas la clave foránea:
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade'); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('safes');
    }
};
