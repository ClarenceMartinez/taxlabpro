<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayPeriodSeeder extends Seeder
{
    public function run(): void
    {
        $payPeriods = [
            ['name' => 'Weekly'],
            ['name' => 'Biweekly'],
            ['name' => 'Semi-Monthly'],
            ['name' => 'Monthly']
        ];

        DB::table('pay_periods')->insert($payPeriods);
    }
}
