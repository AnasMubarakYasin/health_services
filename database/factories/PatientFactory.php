<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
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
            'age' => fake()->randomNumber(2),
            'weight' => fake()->randomNumber(2),
            'height' => fake()->randomNumber(2),
            'date_of_birth' => fake()->date(),
            'place_of_birth' => fake()->city(),
            'gender' => fake()->randomElement(['male', 'female']),
            'remember_token' => Str::random(10),
        ];
    }
}
