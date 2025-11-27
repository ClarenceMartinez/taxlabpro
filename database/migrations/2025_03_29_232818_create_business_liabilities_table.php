<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_liabilities', function (Blueprint $table) {
            $table->id();
            
            // Relación con la tabla clients
            $table->unsignedBigInteger('client_id')->index();
            // O bien: $table->foreignId('client_id')->constrained()->index();

            // Columnas basadas en tu formulario/tabla
            $table->string('description')->nullable();
            $table->string('name')->nullable(); // Por ejemplo, nombre de la institución
            $table->string('street')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('phone')->nullable();

            $table->date('date_pledged')->nullable();
            $table->decimal('balance_owed', 15, 2)->nullable();
            $table->decimal('payment_amount', 15, 2)->nullable();
            $table->date('final_payment')->nullable();

            // Indicar si es secured o unsecured
            // (podrías usar un enum, un booleano, o dos campos boolean)
            $table->enum('collateral', ['secured', 'unsecured'])->nullable();

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
        Schema::dropIfExists('business_liabilities');
    }
};
