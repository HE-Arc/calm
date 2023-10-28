<?php

namespace Database\Factories;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTime();
        $stop = $start->add(new \DateInterval('P2D'));

        return [
            'start' => $start,
            'stop' => $stop,
            'machine_id' => Machine::all()->random()->id,
            'description' => $this->faker->paragraph(),
        ];
    }
}
