<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'street' => fake()->name(),
            'cep' => fake()->name(),
            'neighborhood' => fake()->name(),
            'city' => fake()->name(),
            'state' => fake()->name(),
            'number' => fake()->name(),
            'user_id' => User::factory()
        ];
    }
}
