<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Company;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $companies = Company::all();
        foreach($companies as $key => $company)
        {
            foreach($company->departments  as $department)
            {
                foreach($department->designations as $key => $designation)
                {
                    for($i = 0; $i < 3; $i++)
                    {
                        Employee::create([
                            'designation_id' => $designation->id,
                            'name' => $faker->name(),
                            'email' => $faker->unique()->safeEmail,
                            'phone' => $faker->phoneNumber,
                            'address' =>$faker->address,
                        ]);
                    }
                }
            }
        }
    }
    
}
