<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankAccountType;

class BankAccountTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Checking'],
            ['name' => 'Savings'],
            ['name' => '401k'],
            ['name' => 'IRA'],
            ['name' => 'Money Market'],
            ['name' => 'Certificate of Deposit'],
        ];

        foreach ($types as $type) {
            BankAccountType::create($type);
        }
    }
}
