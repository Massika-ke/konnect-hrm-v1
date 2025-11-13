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

            foreach ($departments as $department) {
                switch ($department->name) {
                    case 'Engineering':
                        $designations = [
                            'Software Engineer',
                            'Cyber Security',
                            'Engineering Manager',
                            'QA Engineer',
                        ];
                        break;

                    case 'Human Resources':
                        $designations = [
                            'HR Manager',
                            'Recruiter',
                            'HR Coordinator',
                        ];
                        break;

                    case 'Finance':
                        $designations = [
                            'Accountant',
                            'Financial Analyst',
                            'Finance Manager',
                        ];
                        break;

                    case 'Marketing':
                        $designations = [
                            'Marketing Manager',
                            'Content Strategist',
                            'SEO Specialist',
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
}
