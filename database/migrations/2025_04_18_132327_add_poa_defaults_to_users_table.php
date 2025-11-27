<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPoaDefaultsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Define the column added just before the business columns start
            $lastIndividualPoaColumn = 'poa2_period'; // Assume this exists

            // === Individuals ===
            // Add poa3 columns after the last known individual poa column
            $table->string("poa3_description")->nullable()->after($lastIndividualPoaColumn);
            $table->string("poa3_form_number")->nullable()->after("poa3_description");
            $table->string("poa3_period")->nullable()->after("poa3_form_number");

            // Keep track of the last added column to chain the 'after' calls correctly
            $lastAddedColumn = 'poa3_period';

            // === Businesses ===
            for ($i = 1; $i <= 3; $i++) {
                $descCol = "poa_bus{$i}_description";
                $formCol = "poa_bus{$i}_form_number";
                $periodCol = "poa_bus{$i}_period";

                $table->string($descCol)->nullable()->after($lastAddedColumn);
                $table->string($formCol)->nullable()->after($descCol);
                $table->string($periodCol)->nullable()->after($formCol);

                // Update the last added column for the next iteration
                $lastAddedColumn = $periodCol;
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Ensure the table exists before attempting to drop columns
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Define the columns added by *this* migration's up() method
                $columnsToDrop = [
                    // Individual POA 3
                    'poa3_description',
                    'poa3_form_number',
                    'poa3_period',
                ];

                // Business POAs 1 to 3
                for ($i = 1; $i <= 3; $i++) {
                    $columnsToDrop[] = "poa_bus{$i}_description";
                    $columnsToDrop[] = "poa_bus{$i}_form_number";
                    $columnsToDrop[] = "poa_bus{$i}_period";
                }

                // Check if columns exist before trying to drop (optional but safer)
                $existingColumns = Schema::getColumnListing('users');
                $columnsToActuallyDrop = array_intersect($columnsToDrop, $existingColumns);

                if (!empty($columnsToActuallyDrop)) {
                    $table->dropColumn($columnsToActuallyDrop);
                }
            });
        }
    }
}