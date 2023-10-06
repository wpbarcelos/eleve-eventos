<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date_start = now()->addDays( rand(10, 30));
        return [
            'name'=> fake()->sentence(3),
            'description'=> fake()->paragraph(1),
            'price'=> fake()->randomElement([0, 20, 50]),
            'date_start'=> $date_start,
            'date_end'=> $date_start,
        ];
    }
}
