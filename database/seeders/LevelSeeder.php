<?php

namespace Database\Seeders;

use App\Enums\LevelType;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       foreach (LevelType::cases() as $level){
           Level::create([
               'name' => $level->value,
               'slug' =>Str::slug($level->value)
           ]);
       }
    }
}
