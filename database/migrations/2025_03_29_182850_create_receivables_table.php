<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('receivables', function (Blueprint $table) {
            $table->id();
            
            // Relación con la tabla clients
            $table->unsignedBigInteger('client_id')->index();
            // o bien: $table->foreignId('client_id')->constrained()->index();
            
            // Columnas de tu formulario/tabla
            $table->enum('type', ['account', 'note'])->nullable();
            $table->string('account_description')->nullable();
            $table->string('status')->nullable();
            $table->date('due_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->decimal('amount_due', 15, 2)->nullable();
            $table->string('address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            
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
        Schema::dropIfExists('receivables');
    }
};
