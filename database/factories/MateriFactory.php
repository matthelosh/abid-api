<?php

namespace Database\Factories;

use App\Models\Bab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materi>
 */
class MateriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $babs = Bab::all();
        $ids = $babs->map(fn ($b) => $b->id);

        return [
            'bab_id' => fake()->randomElement($ids),
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'content' => fake()->realText(3000),
            'cover' => 'https://loremflickr.com/320/240',
        ];
    }
}
