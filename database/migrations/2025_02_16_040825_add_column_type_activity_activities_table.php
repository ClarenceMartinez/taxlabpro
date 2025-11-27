<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The table being modified.
     * @var string
     */
    private string $tableName = 'activities';

    /**
     * The column being added/removed.
     * @var string
     */
    private string $columnName = 'type';

    /**
     * The column to place the new column after.
     * @var string
     */
    private string $afterColumn = 'title';

    /**
     * Run the migrations.
     * Adds a 'type' column to the activities table after the 'title' column.
     */
    public function up(): void
    {
        // Ensure the table exists
        if (!Schema::hasTable($this->tableName)) {
            return;
        }

        Schema::table($this->tableName, function (Blueprint $table) {
            // Ensure the column doesn't already exist (idempotency)
            if (!Schema::hasColumn($this->tableName, $this->columnName)) {
                // Ensure the 'after' column exists before trying to place after it
                if (Schema::hasColumn($this->tableName, $this->afterColumn)) {
                    // Add the column, make it nullable for safety with existing rows
                    $table->string($this->columnName)->nullable()->after($this->afterColumn);
                } else {
                    // Fallback: Add the column without 'after' if 'title' doesn't exist
                    // Or place it after 'id' or another known column
                    // $table->string($this->columnName)->nullable()->after('id');
                    $table->string($this->columnName)->nullable(); // Add at the end
                     // Optional: Log a warning that 'title' column was not found
                    // Log::warning("Migration AddTypeToActivitiesTable: Column '{$this->afterColumn}' not found in table '{$this->tableName}'. '{$this->columnName}' added without specific placement.");
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     * Removes the 'type' column from the activities table.
     */
    public function down(): void
    {
        // Ensure the table exists
        if (!Schema::hasTable($this->tableName)) {
            return;
        }

        Schema::table($this->tableName, function (Blueprint $table) {
            // Ensure the column exists before trying to drop it
            if (Schema::hasColumn($this->tableName, $this->columnName)) {
                $table->dropColumn($this->columnName); // Correctly drop 'type'
            }
        });
    }
};