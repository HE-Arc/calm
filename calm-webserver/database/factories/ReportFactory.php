<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Machine;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => User::all()->random()->id,
            'machine' => Machine::all()->random()->id,
            'description' => $this->faker->paragraph(),
            'acknowledged_at' => $this->faker->dateTime(),
        ];
    }
}
