<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 users, all with role 'Client' (factory defaults to 'Client')
        User::factory()->count(20)->create();
    }
}
