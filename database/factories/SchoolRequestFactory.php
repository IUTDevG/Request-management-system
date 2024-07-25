<?php

namespace Database\Factories;

use App\Enums\SchoolRequestStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolRequest>
 */
class SchoolRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(SchoolRequestStatus::cases()),
            'level_id' => \App\Models\Level::factory(),
            'department_id' => \App\Models\Department::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
