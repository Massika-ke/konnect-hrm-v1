<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
            'name' => 'Safaricom',
            'email' => 'contact@safaricom.com',
            'website' => 'https://www.safaricom.com',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Konnect',
            'email' => 'contact@konnect.com',
            'website' => 'https://www.konnect.com',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Airtel',
            'email' => 'contact@airtel.com',
            'website' => 'https://www.airtel.com',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Zuku',
            'email' => 'contact@zuku.com',
            'website' => 'https://www.zuku.com',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Poa',
            'email' => 'contact@poa.com',
            'website' => 'https://www.poa.com',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);


        foreach (Company::all() as $key => $company) {
            $company->users()->attach(1);
        }
    }
}
