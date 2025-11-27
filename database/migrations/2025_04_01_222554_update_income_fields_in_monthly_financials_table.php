<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * The columns to be added or removed by this migration.
     * @var array<int, string>
     */
    private array $financialColumns = [
        'net_business_income',
        'net_rental_income',
        'child_support_received',
        'alimony_received',
        'primary_gross_wages',
        'spouse_gross_wages',
        'primary_social_security',
        'spouse_social_security',
        'primary_pension',
        'spouse_pension',
        'primary_unemployment',
        'spouse_unemployment',
        'additional_household_income',
        'interested', // Note: 'interested' seems like an unusual name for a decimal income field. Verify if this is correct. Renamed 'interest_income' in example below if needed.
        'dividends_income',
        'distributions',
    ];

    /**
     * Run the migrations.
     * Adds various financial columns to the monthly_financials table.
     */
    public function up(): void
    {
        // Ensure the table exists before attempting to modify it.
        if (!Schema::hasTable('monthly_financials')) {
            // Optional: Log warning
            // Log::warning("Migration AddFinancialColumnsToMonthlyFinancials skipped: table 'monthly_financials' not found.");
            return;
        }

        Schema::table('monthly_financials', function (Blueprint $table) {
            // Determine the column after which new columns should be added.
            // Use 'updated_at' or another known column as a sensible starting point.
            // Adjust 'some_previous_column' if you have a specific logical predecessor.
            $lastKnownColumn = Schema::hasColumn('monthly_financials', 'updated_at')
                ? 'updated_at'
                : (Schema::hasColumn('monthly_financials', 'id') ? 'id' : null);
            // Example alternative: $lastKnownColumn = 'existing_income_total';

            foreach ($this->financialColumns as $column) {
                if (!Schema::hasColumn('monthly_financials', $column)) {
                    // Define the column with nullable decimal type and place it after the last known column.
                    $table->decimal($column, 12, 2)
                          ->nullable()
                          ->after($lastKnownColumn);
                }
                 // Always update $lastKnownColumn to the current column name for the next iteration's ->after()
                 // This ensures sequential ordering based on the $financialColumns array.
                $lastKnownColumn = $column;
            }
        });
    }

    /**
     * Reverse the migrations.
     * Removes the financial columns added by the up() method.
     */
    public function down(): void
    {
        // Ensure the table exists before attempting to modify it.
        if (Schema::hasTable('monthly_financials')) {
            Schema::table('monthly_financials', function (Blueprint $table) {
                // Get currently existing columns in the table.
                $existingColumns = Schema::getColumnListing('monthly_financials');

                // Determine which columns from our list actually exist and need dropping.
                $columnsToActuallyDrop = array_intersect($this->financialColumns, $existingColumns);

                // Drop only the columns that were added by this migration and still exist.
                if (!empty($columnsToActuallyDrop)) {
                    $table->dropColumn($columnsToActuallyDrop);
                }
            });
        }
    }
};