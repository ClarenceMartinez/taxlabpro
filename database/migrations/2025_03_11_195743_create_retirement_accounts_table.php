<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('retirement_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('account_type')->nullable();
            $table->string('account_number')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('city_state_zip')->nullable();
            $table->string('company_phone')->nullable();
            $table->decimal('current_value', 15, 2)->nullable();
            $table->decimal('loan_balance', 15, 2)->nullable();
            $table->date('statement_date')->nullable();
            $table->boolean('used_as_collateral')->default(false);
            $table->boolean('custom_quick_sale')->default(false);
            $table->decimal('fed_tax_rate', 5, 2)->nullable();
            $table->decimal('fed_penalty', 5, 2)->nullable();
            $table->decimal('state_tax_rate', 5, 2)->nullable();
            $table->decimal('state_penalty', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('retirement_accounts');
    }
};
