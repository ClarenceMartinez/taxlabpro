<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_asset_transfers', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla clients
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade');

            $table->string('asset')->nullable();
            $table->date('date_transferred')->nullable();
            $table->decimal('value_at_time_of_transfer', 15, 2)->nullable();
            $table->string('where_transferred')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_asset_transfers');
    }
};
