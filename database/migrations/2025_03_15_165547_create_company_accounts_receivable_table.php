<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('company_accounts_receivable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('account_description')->nullable();
            $table->string('address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            $table->date('due_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->date('amount_due')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_accounts_receivable');
    }
};
