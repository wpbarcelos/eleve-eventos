<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventSubscribe>
 */
class EventSubscribeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->name,
            'date_birth'=> fake()->date('Y-m-d', now()->subYears(10)),
            'gender'=> fake()->randomElement(['F','M']),
            'phone'=> fake()->phoneNumber(),
            'email'=> fake()->safeEmail(),
            'paid'=> fake()->boolean(70),
        ];
    }
}
