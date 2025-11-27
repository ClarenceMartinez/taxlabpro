<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('asset_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('business_name')->nullable();
            $table->string('business_address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('type_of_business')->nullable();
            $table->decimal('ownership_percentage', 5, 2)->nullable();
            $table->string('title')->nullable();
            $table->string('ein')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_transfers');
    }
};
