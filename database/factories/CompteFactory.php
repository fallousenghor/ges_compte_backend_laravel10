<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Compte;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compte>
 */
class CompteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['Épargne', 'Chèque']),
            'solde' => fake()->randomFloat(2, 0, 1000000),
            'statut' => fake()->randomElement(['Actif', 'Bloqué']),
            'dateCreation' => fake()->dateTimeBetween('-2 years', 'now'),
            'user_id' => User::factory()
        ];
    }
}
