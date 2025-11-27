<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypesSeeder extends Seeder
{
    public function run()
    {
        $businessTypes = [
            ['name' => 'Sole Proprietorship'],
            ['name' => 'Partnership'],
            ['name' => 'Corporation'],
            ['name' => 'S Corporation'],
            ['name' => 'LLC (Limited Liability Company)'],
            ['name' => 'Trust'],
            ['name' => 'Non-Profit Organization'],
        ];

        DB::table('business_types')->insert($businessTypes);
    }
}
