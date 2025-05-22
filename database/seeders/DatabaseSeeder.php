<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Candidate;
use Illuminate\Database\Seeder;
use App\Models\Election;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Election::factory()->count(100)->create();
        Candidate::factory()->count(100)->create();
    }
}
