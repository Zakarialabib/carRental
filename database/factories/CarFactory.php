<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CarFactory extends Factory
{/**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Dacia',
            'image' => 'dacia.png',
            'description' => 'DACIA SUPERCAR',
            'brand' => 'DACIATANGER',
            'model' => 'LOGAN - 2023',
            'seats' => '5',
        ];
    }
}