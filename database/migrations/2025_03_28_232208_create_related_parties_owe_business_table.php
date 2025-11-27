<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('related_parties_owe_business', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla clients
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade'); // elimina en cascada si se borra el cliente

            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->date('date_of_loan')->nullable();
            $table->decimal('current_balance', 15, 2)->nullable();
            $table->date('as_of')->nullable();
            $table->date('payment_date')->nullable();
            $table->decimal('payment_amount', 15, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('related_parties_owe_business');
    }
};
