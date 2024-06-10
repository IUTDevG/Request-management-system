<?php
declare(strict_types = 1);
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
        User::factory()->create()->each(function ($user){
            $user->assignRole(RoleType::DIRECTOR);
        });


        User::factory()->create()->each(function ($user){
            $user->assignRole(RoleType::SECRETARY_DIRECTOR);
        });

        User::factory()->create()->each(function ($user){
            $user->assignRole(RoleType::DEPUTY_DIRECTOR);
        });


        $user= User::factory()->create([
            'name'=>'kenmoe',
            'firstName' => 'russel',
            'username' => 'russelodev',
            'email' => 'russeloken@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);

        $user->assignRole(RoleType::COMPUTER_CELL);

        User::factory(10)->create()->each(function ($user){
            $user->assignRole(RoleType::ACADEMIC_MANAGER);
        });

        User::factory(5)->create()->each(function ($user){
           $user->assignRole(RoleType::SCHOOLING);
       });

        User::factory(5)->create()->each(function ($user){
           $user->assignRole(RoleType::USER);
       });


    }
}
