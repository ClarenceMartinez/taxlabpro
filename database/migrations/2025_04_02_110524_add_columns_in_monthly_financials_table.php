<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The columns being added by this migration.
     * @var array
     */
    private $columnsToAdd = [
        'net_business_income',
        'net_rental_income',
        'child_support_received',
        'alimony_received',
    ];

    /**
     * Run the migrations.
     * Adds specific income fields to the monthly_financials table.
     */
    public function up(): void
    {
        // Ensure the table exists before attempting to modify it.
        if (!Schema::hasTable('monthly_financials')) {
            // Optional: Log a warning or message if needed
            // Log::warning("Migration skipped: table 'monthly_financials' not found.");
            return;
        }

        Schema::table('monthly_financials', function (Blueprint $table) {
            // Determine the last column to add fields after.
            // Use 'updated_at' as a sensible default if available, otherwise null.
            $lastKnownColumn = Schema::hasColumn('monthly_financials', 'updated_at') ? 'updated_at' : null;
            // If you know a more specific column these should follow, replace 'updated_at'.
            // Example: $lastKnownColumn = 'other_income';

            // Add net_business_income
            if (!Schema::hasColumn('monthly_financials', 'net_business_income')) {
                $table->decimal('net_business_income', 12, 2)
                      ->nullable()
                      ->after($lastKnownColumn); // Add after clause
                $lastKnownColumn = 'net_business_income'; // Update for the next column
            } else if ($lastKnownColumn === null || $lastKnownColumn === 'updated_at') {
                 // If the column already exists, make sure lastKnownColumn is updated
                 // so subsequent columns are placed correctly relative to it.
                 $lastKnownColumn = 'net_business_income';
            }


            // Add net_rental_income
            if (!Schema::hasColumn('monthly_financials', 'net_rental_income')) {
                $table->decimal('net_rental_income', 12, 2)
                      ->nullable()
                      ->after($lastKnownColumn); // Add after clause
                $lastKnownColumn = 'net_rental_income'; // Update for the next column
             } else if ($lastKnownColumn === 'net_business_income') {
                 $lastKnownColumn = 'net_rental_income';
             }

            // Add child_support_received
            if (!Schema::hasColumn('monthly_financials', 'child_support_received')) {
                $table->decimal('child_support_received', 12, 2)
                      ->nullable()
                      ->after($lastKnownColumn); // Add after clause
                $lastKnownColumn = 'child_support_received'; // Update for the next column
             } else if ($lastKnownColumn === 'net_rental_income') {
                 $lastKnownColumn = 'child_support_received';
             }

            // Add alimony_received
            if (!Schema::hasColumn('monthly_financials', 'alimony_received')) {
                $table->decimal('alimony_received', 12, 2)
                      ->nullable()
                      ->after($lastKnownColumn); // Add after clause
                // No need to update $lastKnownColumn after the last one
            }
             // No else if needed for the last column
        });
    }

    /**
     * Reverse the migrations.
     * Removes the specific income fields added in the up() method.
     */
    public function down(): void
    {
        // Ensure the table exists before attempting to modify it.
        if (Schema::hasTable('monthly_financials')) {
            Schema::table('monthly_financials', function (Blueprint $table) {
                // Check which of the columns added by this migration actually exist.
                $existingColumns = Schema::getColumnListing('monthly_financials');
                $columnsToActuallyDrop = array_intersect($this->columnsToAdd, $existingColumns);

                // Drop only the columns that were added and currently exist.
                if (!empty($columnsToActuallyDrop)) {
                    $table->dropColumn($columnsToActuallyDrop);
                }
            });
        }
    }
};