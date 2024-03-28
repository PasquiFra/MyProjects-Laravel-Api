<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;

use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project_ids = Project::pluck('id')->toArray();

        $technologies = [
            ['label' => 'HTML', 'color' => '#FE426E'],
            ['label' => 'CSS', 'color' => '#E8912D'],
            ['label' => 'JS', 'color' => '4bd2ed'],
            ['label' => 'Bootstrap', 'color' => '#018800'],
            ['label' => 'VUE', 'color' => '#28A36D'],
            ['label' => 'SQL', 'color' => '#8EB600'],
            ['label' => 'PHP', 'color' => '#0E71EB'],
            ['label' => 'Laravel', 'color' => '#36D700'],
        ];

        foreach ($technologies as $tech) {
            $new_tech = new Technology();

            $new_tech->label = $tech['label'];
            $new_tech->color = $tech['color'];

            $new_tech->save();

            $technology_projects = [];
            foreach ($project_ids as $project_id) {
                if (rand(0, 1)) $technology_projects[] = $project_id;
            }
            $new_tech->projects()->attach($technology_projects);
        }
    }
}
