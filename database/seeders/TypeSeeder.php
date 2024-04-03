<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $labels = ['FrontEnd', 'BackEnd', 'FullStack', 'Design', 'UI/UX'];

        foreach ($labels as $label) {
            $type = new Type();

            $type->slug = Str::slug($label);
            $type->label = $label;
            $type->color = $faker->hexColor();

            $type->save();
        }
    }
}
