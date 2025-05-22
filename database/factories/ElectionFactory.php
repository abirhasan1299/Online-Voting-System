<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Election>
 */
class ElectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker()->sentence(4);

        return [
            'title'=>$title,
            'description'=>$this->faker()->paragraph,
            'status'=>$this->faker->randomElement(['pending','published','running']),
            'start_date'=>now()->addDays(rand(1,5)),
            'end_date'=>now()->addDays(rand(6,10)
        ];
    }
}
