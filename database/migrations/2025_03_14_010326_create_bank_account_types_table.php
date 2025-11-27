<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bank_account_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nombre del tipo de cuenta (Ej: Checking, Savings, 401k, IRA)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_account_types');
    }
};
