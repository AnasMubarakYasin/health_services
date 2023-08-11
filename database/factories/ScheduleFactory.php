<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day' => fake()->randomElement([
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                // 'saturday',
                // 'sunday',
            ]),
            'started_at' => fake()->time(),
            'ended_at' => fake()->time(),
            'active' => fake()->boolean(),
            'midwife_id' => '0',
        ];
    }
}
