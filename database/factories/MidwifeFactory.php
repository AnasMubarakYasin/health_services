<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Midwife>
 */
class MidwifeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->userName(),
            'password' => '1234',
            'photo' => fake()->imageUrl(),
            'fullname' => fake()->name(),
            'telp' => fake()->phoneNumber(),
            'srt' => fake()->unique()->regexify('[0-9]{11}'),
            'remember_token' => Str::random(10),
        ];
    }
}
