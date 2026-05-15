<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'tanishq@admin.com'],
            [
                'name' => 'Tanishq',
                'password' => Hash::make('Tanishq@2026'),
            ]
        );
    }
}
