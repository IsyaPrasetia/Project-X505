<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Admin Testing',
            'email' => 'admin@project.id',
            'password' => 'Project2026',
        ]);
    }
}
