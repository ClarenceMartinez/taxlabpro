<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class InitSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@taxlabpro.com',
                'email_verified_at' => $now,
                'password' => Hash::make('#superTAX25'),
                'firm_ein' => null, 
                'caf_no' => null, 
                'ptin' => null, 
                'ctec' => null, 
                'ny_tprin' => null, 
                'designation' => null, 
                'licensing_jurisdiction' => null, 
                'license_no' => null, 
                'a2a' => null,
                'type' => '1',
                'status' => '1',
                'avatar' => '1',
                'company_id' => '1',
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@taxlabpro.com',
                'email_verified_at' => $now,
                'password' => Hash::make('#adminTAX25'),
                'firm_ein' => null, 
                'caf_no' => null, 
                'ptin' => null, 
                'ctec' => null, 
                'ny_tprin' => null, 
                'designation' => null, 
                'licensing_jurisdiction' => null, 
                'license_no' => null, 
                'a2a' => null,
                'type' => '2',
                'status' => '1',
                'avatar' => '2',
                'company_id' => '1',
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'User',
                'email' => 'user@taxlabpro.com',
                'email_verified_at' => $now,
                'password' => Hash::make('#userTAX25'),
                'firm_ein' => null, 
                'caf_no' => null, 
                'ptin' => null, 
                'ctec' => null, 
                'ny_tprin' => null, 
                'designation' => null, 
                'licensing_jurisdiction' => null, 
                'license_no' => null, 
                'a2a' => null,
                'type' => '3',
                'status' => '1',
                'avatar' => '3',
                'company_id' => '1',
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Client',
                'email' => 'client@taxlabpro.com',
                'email_verified_at' => $now,
                'password' => Hash::make('#clientTAX25'),
                'firm_ein' => null, 
                'caf_no' => null, 
                'ptin' => null, 
                'ctec' => null, 
                'ny_tprin' => null, 
                'designation' => null, 
                'licensing_jurisdiction' => null, 
                'license_no' => null, 
                'a2a' => null,
                'type' => '4',
                'status' => '1',
                'avatar' => '4',
                'company_id' => '1',
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
        
        DB::table('company')->insert([
            'name' => 'TaxLabPro',
            'state_id' => 1, 
            'city' => 'Denver',
            'slug' => Str::slug("TaxLabPro"),
            'address_1' => 'TaxLabPro address1',
            'address_2' => 'TaxLabPro address2',
            'office_phone' => '123-456-7890',
            'office_cell' => '098-765-4321',
            'status' => 1,
            'user_id' => 1, 
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null, 
        ]);
        DB::table('company')->insert([
            'name' => 'TaxLabProDev',
            'state_id' => 1, 
            'city' => 'Denver',
            'slug' => Str::slug("TaxLabProDev"),
            'address_1' => 'TaxLabPro address1',
            'address_2' => 'TaxLabPro address2',
            'office_phone' => '123-456-7890',
            'office_cell' => '098-765-4321',
            'status' => 1,
            'user_id' => 1, 
            'created_at' => $now,
            'updated_at' => $now,
            'deleted_at' => null, 
        ]);

        DB::table('avatar')->insert([
            ['name' => 'avatar', 'image' => '1.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'avatar', 'image' => '2.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'avatar', 'image' => '3.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'avatar', 'image' => '4.png', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
