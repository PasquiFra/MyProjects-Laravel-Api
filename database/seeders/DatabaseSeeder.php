<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Pasqui',
        //     'email' => 'fra@example.com',
        // ]);

        $this->call([TypeSeeder::class]);

        \App\Models\Project::factory(10)->create();

        $this->call([TechnologySeeder::class]);
    }
}
