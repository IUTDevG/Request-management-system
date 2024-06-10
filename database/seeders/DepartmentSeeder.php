<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Genie Informatique', 'abbreviation' => 'GI'],
            ['name' => 'Organisation et Gestion Administrative', 'abbreviation' => 'OGA'],
            ['name' => 'Genie Electrique et Informatique Industrielle', 'abbreviation' => 'GEII'],
            ['name' => 'Genie Mecanique et Productivité', 'abbreviation' => 'GMP'],
        ];

        foreach ($departments as $department) {
            Department::create([
                'name' => $department['name'],
                'abbreviation' => $department['abbreviation'],
                'slug' => Str::slug($department['name']),
            ]);
        }

    }
}
