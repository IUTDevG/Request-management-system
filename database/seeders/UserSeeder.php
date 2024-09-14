<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'fotso',
            'firstName' => 'darwin',
            'username' => 'darwin_nathan',
            'email' => 'fotsodarwin+1@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);

        $user->assignRole(RoleType::COMPUTER_CELL);

        $user = User::factory()->create([
            'name' => 'Kengne',
            'firstName' => 'Jiordi',
            'username' => 'jiordikengne',
            'email' => 'jiordikengne+1@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole(RoleType::COMPUTER_CELL);



    }
}
