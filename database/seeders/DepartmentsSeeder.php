<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $departments = $company->departments()->createMany([
                [
                    'name' => 'Engineering',
                ],
                [
                    'name' => 'Human Resources',
                ],
                [
                    'name' => 'Finance',
                ],
                [
                    'name' => 'Marketing',
                ],
            ]);
        }

        foreach ($departments as $department) {
            switch ($department->name) {
                case 'Engineering':
                    $designations = [
                        ['name' => 'Software Engineer'],
                        ['name' => 'Cyber Security'],
                        ['name' => 'Engineering Manager'],
                        ['name' => 'QA Engineer'],
                    ];
                    break;

                case 'Human Resources':
                    $designations = [
                        ['name' => 'HR Manager'],
                        ['name' => 'Recruiter'],
                        ['name' => 'HR Coordinator'],
                    ];
                    break;

                case 'Finance':
                    $designations = [
                        ['name' => 'Accountant'],
                        ['name' => 'Financial Analyst'],
                        ['name' => 'Finance Manager'],
                    ];
                    break;

                case 'Marketing':
                    $designations = [
                        ['name' => 'Marketing Manager'],
                        ['name' => 'Content Strategist'],
                        ['name' => 'SEO Specialist'],
                    ];
                    break;
                default:
                    $designations = [];
                    break;
            }
            foreach ($designations as $designation) {
                $department->designations()->create([
                    'name' => $designation,
                ]);
            }
        }
    }
}
