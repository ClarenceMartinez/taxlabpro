<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('digital_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('description')->nullable();
            $table->string('email')->nullable();
            $table->string('asset_name')->nullable();
            $table->string('account_number')->nullable();
            $table->integer('units')->nullable();
            $table->string('digital_address')->nullable();
            $table->string('location')->nullable();
            $table->decimal('current_value', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_assets');
    }
};
