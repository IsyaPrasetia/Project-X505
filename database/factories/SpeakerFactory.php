<?php

namespace Database\Factories;

use App\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    protected $model = Speaker::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'title' => fake()->jobTitle(),
            'inst' => fake()->company(),
            'avatar' => null,
            'gender' => fake()->randomElement(['L', 'P']),
            'sort_order' => 0,
            'is_active' => true,
            'date' => fake()->date(),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
}
