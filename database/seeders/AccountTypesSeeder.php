<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountTypes = [
            'Stocks',
            'Bonds',
            'Retirement Accounts',
            'Mutual Funds',
            'Other Investments'
        ];

        foreach ($accountTypes as $type) {
            DB::table('account_types')->insert([
                'name' => $type
            ]);
        }
    }
}
