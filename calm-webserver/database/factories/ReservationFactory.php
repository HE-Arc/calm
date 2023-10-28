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
        $start = $this->faker->dateTime();
        $stop = $start->add(new \DateInterval('PT1H'));
        $user = User::all()->random();
        $organization = $user->organizations->random();
        $laundry = $organization->laundries->random();
        $machine = $laundry->machines->random();
        return [
            'start' => $start,
            'stop' => $stop,
            'machine_id' => $machine->id,
            'user_id' => $user->id,
        ];
    }
}
