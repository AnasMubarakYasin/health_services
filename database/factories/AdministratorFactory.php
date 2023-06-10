<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrator>
 */
class AdministratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'photo' => fake()->imageUrl(),
            'name' => fake()->unique()->userName(),
            'fullname' => fake()->name(),
            'address' => fake()->address(),
            'telp' => fake()->unique()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '1234',
            'remember_token' => Str::random(10),
        ];
    }
}
