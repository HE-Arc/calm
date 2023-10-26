<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Machine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start' => $this->faker->dateTime(),
            'stop' => $this->faker->dateTime(),
            'machine' => Machine::all()->random()->id,
            'user' => User::all()->random()->id,
        ];
    }
}
