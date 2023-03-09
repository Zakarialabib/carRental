<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RoleType;
use App\Models\Car;
use App\Models\Section;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /** Seed the application's database. */
    public function run(): void
    {
        User::factory(10)->create();
        Section::factory(10)->create();
        Car::factory(10)->create();

        User::factory()->create([
            'name'     => 'Test User',
            'phone'    => fake()->phoneNumber(),
            'email'    => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'     => RoleType::ADMIN,
        ]);
    }
}
