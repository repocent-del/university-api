<?php

namespace Database\Seeders;

use App\Models\Professor;
use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Professor::factory()
            ->count(10)
            ->hasCourses(rand(1, 5))
            ->create();
    }
}
