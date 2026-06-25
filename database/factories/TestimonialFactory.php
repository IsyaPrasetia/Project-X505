<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'title' => fake()->jobTitle(),
            'text' => fake()->paragraph(),
            'stars' => '★★★★★',
            'avatar' => null,
            'gender' => fake()->randomElement(['male', 'female']),
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
