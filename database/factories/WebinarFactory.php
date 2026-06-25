<?php

namespace Database\Factories;

use App\Models\Webinar;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebinarFactory extends Factory
{
    protected $model = Webinar::class;

    public function definition(): array
    {
        return [
            'tag' => fake()->word(),
            'title' => fake()->sentence(),
            'date' => fake()->dateTimeBetween('+1 day', '+1 month'),
            'time' => '09:00',
            'flyer' => null,
            'platform' => 'Zoom',
            'duration' => 120,
            'skp' => fake()->randomNumber(2),
            'price' => fake()->randomNumber(5),
            'price2' => null,
            'register_link' => fake()->url(),
            'lms_link' => null,
            'professions' => 'Dokter Umum',
            'admin_left_name' => null,
            'admin_left_link' => null,
            'admin_right_name' => null,
            'admin_right_link' => null,
            'health_channel_text' => null,
            'health_channel_link' => null,
            'health_channel_btn_text' => null,
            'speakers' => null,
            'is_active' => true,
            'register_closed' => false,
            'wa_message' => null,
            'bank_name' => null,
            'bank_account_no' => null,
            'bank_account_name' => null,
            'bank_logo' => null,
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
            'register_closed' => false,
            'date' => fake()->dateTimeBetween('+1 day', '+1 month'),
        ]);
    }
}
