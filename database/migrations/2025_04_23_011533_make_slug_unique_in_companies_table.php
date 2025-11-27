<?php

// database/migrations/2025_04_25_XXXXXX_make_slug_unique_in_companies_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSlugUniqueInCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            // ahora que todos los slugs están poblados y son únicos...
            $table->string('slug')->nullable(false)->change();
            $table->unique('slug');
        });
    }

    public function down()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->string('slug')->nullable()->change();
        });
    }
}
