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
        

        Schema::create('lawsuits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['plaintiff', 'defendant'])->nullable();
            $table->string('subject_of_suit')->nullable();
            $table->string('location_of_filing')->nullable();
            $table->string('city')->nullable();
            $table->string('represented_by')->nullable();
            $table->string('amount_of_suit')->nullable();
            $table->string('docket_case_number')->nullable();
            $table->date('possible_completion_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawsuits');
    }
};
