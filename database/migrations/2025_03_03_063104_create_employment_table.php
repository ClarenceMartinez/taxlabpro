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
        Schema::create('employment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('employer')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 50)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('work_phone')->nullable();
            $table->boolean('contact_at_work_allowed')->default(false);
            $table->string('occupation')->nullable();
            $table->integer('business_interest')->default(0);
            $table->string('employed_status')->nullable();
            $table->string('pay_period')->nullable();
            $table->decimal('gross_wage', 10, 2)->default(0.00);
            $table->decimal('federal_tax', 10, 2)->default(0.00);
            $table->decimal('state_tax', 10, 2)->default(0.00);
            $table->decimal('local_tax', 10, 2)->default(0.00);
            $table->boolean('does_not_withhold_social_security')->default(false);
            $table->boolean('does_not_withhold_medicare')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment');
    }
};
