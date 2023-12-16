<?php

namespace Database\Factories;

use App\Models\Laundry;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Utils\MachineType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'laundry_id' => Laundry::all()->random()->id,
            'type' => $this->faker->randomElement(MachineType::names()),
        ];
    }
}
