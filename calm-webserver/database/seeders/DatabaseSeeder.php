<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OrganizationSeeder::class,
            UserSeeder::class,

            UserInOrganizationSeeder::class,

            LaundrySeeder::class,
            MachineSeeder::class,

            MessageSeeder::class,
            ReservationSeeder::class,
            MaintenanceSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
