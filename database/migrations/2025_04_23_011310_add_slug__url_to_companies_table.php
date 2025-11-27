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
        $companies = DB::table('company')->select('id','name')->get();

        foreach ($companies as $c) {
            // genera el slug base
            $base = Str::slug($c->name, '-');

            // si ya existe, añádele el ID para que sea único
            $slug = DB::table('company')->where('slug', $base)->exists()
                ? "{$base}-{$c->id}"
                : $base;

            DB::table('company')
              ->where('id', $c->id)
              ->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('company')->update(['slug' => null]);
    }
};
