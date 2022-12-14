<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'subject' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(2, true),
            'category' => $this->faker->randomElement(['사료','그루밍','집사후기']),
        ];
    }
}
