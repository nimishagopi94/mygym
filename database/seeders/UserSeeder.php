<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::factory()->create([
        'name'=>'nimishaGopi',
        'email'=>'nimishagopi94@gmail.com',
        'role'=>'member'
       ]);
       User::factory()->create([
        'name'=>'anfarsahil',
        'email'=>'anfarsahil@gmail.com',
        'role'=>'instructor'
       ]);
       User::factory()->create([
        'name'=>'taylor',
        'email'=>'taylor@gmail.com',
        'role'=>'instructor'
       ]);

       User::factory()->count(10)->create([        
        'role'=>'instructor'
       ]);
       User::factory()->count(10)->create();
    }
}
