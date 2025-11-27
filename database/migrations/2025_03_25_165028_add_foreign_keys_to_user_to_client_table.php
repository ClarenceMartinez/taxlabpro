<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('user_to_client', function (Blueprint $table) {
            if (!Schema::hasColumn('user_to_client', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }

            if (!Schema::hasColumn('user_to_client', 'client_id')) {
                $table->unsignedBigInteger('client_id')->after('user_id');
            }

            // Agregar claves foráneas si no existen
            if (!Schema::hasColumn('user_to_client', 'user_id') && !Schema::hasColumn('user_to_client', 'client_id')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('user_to_client', function (Blueprint $table) {
            //$table->dropForeign(['user_id']);
            //$table->dropForeign(['client_id']);
            $table->dropColumn(['user_id', 'client_id']);
        });
    }
};
