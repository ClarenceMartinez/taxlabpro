<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            // lo dejamos nullable para poder poblarlo sin errores
            $table->string('slug')->nullable()->after('name');
        });
    }

    public function down()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
