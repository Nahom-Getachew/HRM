<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Psy\ConfigPaths;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            'name' => 'Acme Corporation',
            'email' => 'info@acmecorp.com',
            'website' => 'https://www.acmecorp.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('companies')->insert([
            'name' => 'Globex Corporation',
            'email' => 'contact@globex.com',
            'website' => 'https://www.globex.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('companies')->insert([
            'name' => 'Initech',
            'email' => 'info@initech.com',
            'website' => 'https://www.initech.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('companies')->insert([
            'name' => 'Draco Systems',
            'email' => 'info@dracosystemseth.com',
            'website' => 'https://www.dracosystemseth.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach(Company::all() as $key => $company) 
        {
            $company->users()->attach(1); // Attach user with ID 1 to each company
        }
    }
}


