<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassType;
class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        classType::create([
            'name'=>'yoga',
            'description'=>fake()->text(),
            'minutes'=>30
        ]);
        classType::create([
            'name'=>'zumba',
            'description'=>fake()->text(),
            'minutes'=>60
        ]);
        classType::create([
            'name'=>'dance',
            'description'=>fake()->text(),
            'minutes'=>40
        ]);
        classType::create([
            'name'=>'gym',
            'description'=>fake()->text(),
            'minutes'=>60
        ]);
    }
}
