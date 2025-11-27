<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pay_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nombre del período de pago
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pay_periods');
    }
};
