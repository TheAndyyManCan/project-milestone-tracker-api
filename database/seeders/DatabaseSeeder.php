<?php

namespace Database\Seeders;

use App\Models\Milestone;
use App\Models\Project;
use App\Models\User;
use Database\Factories\MilestoneFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create();

        Project::factory()
            ->count(10)
            ->for($user)
            ->has(Milestone::factory(3)->for($user))
            ->create();
    }
}
