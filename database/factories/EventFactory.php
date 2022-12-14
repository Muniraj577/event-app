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
    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('-30 days', '+1 month');
        return [
            'title' => $this->faker->sentence('5', true),
            'description' => $this->faker->paragraph(3),
            'start_date' => $start_date,
            'end_date' => $this->faker->dateTimeBetween($start_date, '+1 month'),
        ];
    }
}
