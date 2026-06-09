<?php

namespace Tests\Feature;

use App\Models\ContactSetting;
use App\Models\Speaker;
use App\Models\Testimonial;
use App\Models\Webinar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        Webinar::factory()->active()->create();
        Speaker::factory()->active()->create();
        Testimonial::factory()->active()->create();
        ContactSetting::create(['key' => 'email', 'value' => 'test@example.com']);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
