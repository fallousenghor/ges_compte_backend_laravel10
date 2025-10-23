<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        return [
            'departement' => fake()->randomElement(['IT', 'Finance', 'RH', 'Marketing']),
            'fonction' => fake()->jobTitle(),
        ];
    }
}
