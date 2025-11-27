<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('credit_lines', function (Blueprint $table) {
            $table->id();
            
            // Relación con la tabla clients
            $table->unsignedBigInteger('client_id')->index();
            // o bien: $table->foreignId('client_id')->constrained()->index();

            // Columnas basadas en tu formulario
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('property_security')->nullable();
            $table->decimal('credit_limit', 15, 2)->nullable();
            $table->decimal('loan_balance', 15, 2)->nullable();
            $table->decimal('minimum_monthly_pmt', 15, 2)->nullable();
            $table->date('statement_date')->nullable();

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
        Schema::dropIfExists('credit_lines');
    }
};
