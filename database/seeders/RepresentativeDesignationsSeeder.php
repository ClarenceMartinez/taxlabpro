<?php

namespace Database\Seeders;

// database/seeders/RepresentativeDesignationsSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepresentativeDesignationsSeeder extends Seeder {
    public function run(): void {
        DB::table('representative_designations')->insert([
            ['code' => 'A', 'description' => 'Attorney'],
            ['code' => 'B', 'description' => 'Certified Public Accountant'],
            ['code' => 'C', 'description' => 'Enrolled Agent'],
            ['code' => 'D', 'description' => 'Officer of Corporation'],
            ['code' => 'E', 'description' => 'Full-Time Employee (Business)'],
            ['code' => 'F', 'description' => 'Family Member'],
            ['code' => 'G', 'description' => 'Enrolled Actuary'],
            ['code' => 'H', 'description' => 'Unenrolled Return Preparer'],
            ['code' => 'R', 'description' => 'Registered Tax Return Preparer'],
        ]);
    }
}
