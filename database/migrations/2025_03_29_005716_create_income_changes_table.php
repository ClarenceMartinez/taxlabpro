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
        Schema::create('income_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->index(); // Relación con la tabla clients
            // Ejemplo de columnas según la pregunta
            $table->boolean('anticipated')->default(false); // 'Yes' or 'No' (true/false)
            $table->string('explanation')->nullable();       // Texto para explicar el cambio
            $table->decimal('amount', 10, 2)->nullable();    // Monto de aumento o disminución
            $table->date('date_of_change')->nullable();      // Fecha cuando ocurrirá el cambio
            $table->timestamps();

            // Clave foránea (opcional, si quieres forzar la relación)
            // $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_changes');
    }
};
