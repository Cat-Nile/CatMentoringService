<?php

namespace Database\Factories;

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
            'name' => fake()->name()."냥이",
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'breed' => $this->faker->randomElement([
                'turkish_angora', 'siamese', 'scottish_fold', 'russian_blue', 'munchkin', 'korean_short_hair', 'snowshoe'
            ]),
            'age' => rand(1, 15),
            'hair' => $this->faker->randomElement([
                'white', 'grey', 'black', 'tricolor', 'tuxedo', 'mackerel_tabby', 'ginger'
            ]),
            'role' => $this->faker->randomElement(['mentor','mentee']),
            //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
