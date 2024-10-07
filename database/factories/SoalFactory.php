<?php

namespace Database\Factories;

use App\Models\Materi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Soal>
 */
class SoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materis = Materi::all();
        $ids = $materis->map(fn($m) => $m->id);
        return [
            'materi_id' => fake()->randomElement($ids),
            'pertanyaan' => fake()->realText(),
            'a' => fake()->sentence(10),
            'b' => fake()->sentence(10),
            'c' => fake()->sentence(10),
            'd' => fake()->sentence(10),
            'kunci' => fake()->randomElement(['a', 'b', 'c', 'd'])
        ];
    }
}
