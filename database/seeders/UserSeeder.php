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
        $user = User::factory()->create();
        $user->assignRole(RoleType::DIRECTOR);

        $user = User::factory()->create();
        $user->assignRole(RoleType::SECRETARY_DIRECTOR);


        $user = User::factory()->create();
        $user->assignRole(RoleType::DEPUTY_DIRECTOR);

        $user = User::factory()->create();
        $user->assignRoleWithDepartment(RoleType::HEAD_OF_DEPARTMENT->value, 1);


        $user= User::factory()->create([
            'name'=>'kenmoe',
            'firstName' => 'russel',
            'username' => 'russelodev',
            'email' => 'russeloken@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);
        $user->assignRole(RoleType::COMPUTER_CELL);
        $user= User::factory()->create([
            'name'=>'fotso',
            'firstName' => 'darwin',
            'username' => 'darwin_nathan',
            'email' => 'fotsodarwin@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),

        ]);

        $user->assignRole(RoleType::COMPUTER_CELL);

        User::factory(2)->create()->each(function ($user){
            $user->assignRoleWithDepartment(RoleType::ACADEMIC_MANAGER->value, 1);
        });

        User::factory(2)->create()->each(function ($user){
           $user->assignRoleWithDepartment(RoleType::SCHOOLING->value,1);
       });

        User::factory(5)->create()->each(function ($user){
           $user->assignRole(RoleType::USER);
       });


    }
}
