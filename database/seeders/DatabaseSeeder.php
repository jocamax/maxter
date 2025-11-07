<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'email@email.com')],
            [
                'name' => env('ADMIN_NAME', 'Store Admin'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'super-strong-password')),
                // 'is_admin' => true,
            ]
        );
    }
}
