<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);

        $img = fake()->image(null, 250, 250);

        $slug = Str::slug($title);

        Storage::makeDirectory('projects_images');

        $img_url = Storage::putFileAs('projects_images', $img, "$slug.png");

        $type_ids = Type::pluck('id')->toArray();


        return [
            'title' => $title,
            'slug' => $slug,
            'type_id' => Arr::random($type_ids),
            'description' => fake()->sentence(30),
            'project_url' => fake()->url(),
            'image' =>  $img_url,
            'is_published' => fake()->numberBetween(0, 1),
        ];
    }
}
