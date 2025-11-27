<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The name of the table.
     * @var string
     */
    private string $tableName = 'employment_spouse';

    /**
     * Run the migrations.
     * Creates the employment_spouse table.
     */
    public function up(): void
    {
        // Check if the table already exists before attempting to create it
        if (!Schema::hasTable($this->tableName)) {
            Schema::create($this->tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                // Ensure 'clients' table exists for the foreign key constraint
                $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
                $table->string('employer')->nullable();
                $table->string('street')->nullable();
                $table->string('city')->nullable();
                $table->string('state', 50)->nullable();
                $table->string('zip_code', 20)->nullable();
                $table->string('work_phone')->nullable();
                $table->boolean('contact_at_work_allowed')->default(false);
                $table->string('occupation')->nullable();
                $table->string('employer_year', 20)->nullable(); // Consider integer if only storing year number
                $table->string('employer_month', 20)->nullable(); // Consider integer if only storing month number
                $table->integer('business_interest')->default(0); // e.g., Percentage owned
                $table->string('employed_status')->nullable(); // e.g., 'Employed', 'Self-Employed', 'Unemployed'
                $table->string('pay_period')->nullable(); // e.g., 'Weekly', 'Bi-Weekly', 'Monthly'
                $table->decimal('gross_wage', 10, 2)->default(0.00);
                $table->decimal('federal_tax', 10, 2)->default(0.00);
                $table->decimal('state_tax', 10, 2)->default(0.00);
                $table->decimal('local_tax', 10, 2)->default(0.00);
                $table->string('does_claimed_form', 250)->nullable(); // Clarify purpose? Maybe text/boolean?
                $table->boolean('does_not_withhold_social_security')->default(false);
                $table->boolean('does_not_withhold_medicare')->default(false);
                $table->timestamps(); // Adds created_at and updated_at
                $table->softDeletes(); // Adds deleted_at
            });
        }
    }

    /**
     * Reverse the migrations.
     * Drops the employment_spouse table.
     */
    public function down(): void
    {
        // Use dropIfExists for safety - won't error if table doesn't exist
        Schema::dropIfExists($this->tableName);
    }
};