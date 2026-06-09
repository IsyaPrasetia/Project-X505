<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use Illuminate\Database\Seeder;

class ContactSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'address' => '',
            'phone' => '',
            'email' => '',
            'whatsapp' => '',
            'instagram' => '',
            'youtube' => '',
            'maps_embed' => '',
        ];

        foreach ($settings as $key => $value) {
            ContactSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
