<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('representative_designations', function (Blueprint $table) {
            $table->id();
            $table->char('code', 1)->unique(); // A, B, C, etc.
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('representative_designations');
    }
};
