<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Compte;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientCompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 clients
        Client::factory()->count(10)->create()->each(function (Client $client) {
            // For each client create a linked User
            $user = $client->user()->create([
                'prenom' => fake()->firstName(),
                'nom' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'telephone' => fake()->phoneNumber(),
                'adresse' => fake()->address(),
            ]);

            // Create 2 comptes for that user
            Compte::factory()->count(2)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
