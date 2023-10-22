<?php

namespace Database\Seeders;

use \App\Models\User;
use \App\Models\Organization;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserInOrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = Organization::all();
        User::all()->each(function ($user) use ($organizations) {
            $user->organizations()->attach($organizations->random()->id);
        });
    }
}
