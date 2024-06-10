<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Enums\SchoolRequestStatus;
use App\Models\Department;
use App\Models\Level;
use App\Models\SchoolRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =   User::factory()->create();
        $user->assignRole(RoleType::SCHOOLING);

        $schoolRequest =SchoolRequest::create([
            'title' => 'Absence de notes en algorithme',
            'description' => fake()->paragraph(4),
            'status' => SchoolRequestStatus::Submitted,
            'matricule' => Str::random(8),
            'level_id' => (int) Level::first()->id,
            'department_id' => (int) Department::first()->id,
            'user_id' => (int) $user->id,
        ]);

        $paths = [
            'media-library/school-request/quitus_inscription_speciale.pdf',
            'media-library/school-request/quitus_tranche2.pdf',
            'media-library/school-request/quitus_visite_medicale.pdf',
            ];
        foreach ($paths as $path){

         $schoolRequest->addMedia(storage_path($path))->toMediaCollection('school-request');
        }

    }
}
