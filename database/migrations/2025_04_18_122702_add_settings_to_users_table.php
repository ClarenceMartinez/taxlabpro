<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     * Adds timezone, email signature, and default POA fields to the users table.
     *
     * @return void
     */
    public function up()
    {
        // Check if the table exists before attempting to modify it
        // Although modifying 'users' is standard, this is good practice for any table.
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Determine the column to place 'timezone' after.
                // Default to 'password' if 'remember_token' isn't found (adjust if needed).
                $afterColumn = Schema::hasColumn('users', 'remember_token') ? 'remember_token' : 'password';

                // Add general settings
                $table->string('timezone')->nullable()->after($afterColumn);
                $table->text('email_signature')->nullable()->after('timezone');

                // Add Defaults Power of Attorney Set 1
                $table->string('poa1_description')->nullable()->after('email_signature');
                $table->string('poa1_form_number')->nullable()->after('poa1_description');
                $table->string('poa1_period')->nullable()->after('poa1_form_number');

                // Add Defaults Power of Attorney Set 2
                $table->string('poa2_description')->nullable()->after('poa1_period');
                $table->string('poa2_form_number')->nullable()->after('poa2_description');
                $table->string('poa2_period')->nullable()->after('poa2_form_number');
            });
        }
    }

    /**
     * Reverse the migrations.
     * Removes the settings and default POA fields added in the up() method.
     *
     * @return void
     */
    public function down()
    {
        // Check if the table exists before attempting to modify it
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Define the specific columns added by this migration's up() method
                $columnsToDrop = [
                    'timezone', 'email_signature',
                    'poa1_description', 'poa1_form_number', 'poa1_period',
                    'poa2_description', 'poa2_form_number', 'poa2_period',
                ];

                // Check which of these columns actually exist in the table currently
                // This prevents errors if rollback is attempted when columns are already gone.
                $existingColumns = Schema::getColumnListing('users');
                $columnsToActuallyDrop = array_intersect($columnsToDrop, $existingColumns);

                // Drop only the columns that exist
                if (!empty($columnsToActuallyDrop)) {
                    $table->dropColumn($columnsToActuallyDrop);
                }
            });
        }
    }
}