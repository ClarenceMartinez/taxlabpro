<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AccountTypesSeeder::class,
            BankAccountTypeSeeder::class,
            BusinessTypesSeeder::class,
            PayPeriodSeeder::class,
            InitSeeder::class,
            PresetSeeder::class,
            RepresentativeDesignationsSeeder::class,
            UpdateClientSlugSeeder::class
            //ClientSeeder::class, Complete the factory first
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
