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
                '터키시앙고라', '샴', '스코티시폴드', '러시안블루', '먼치킨', '코리안쇼트헤어', '스노우슈'
            ]),
            'age' => rand(1, 15),
            'hair' => $this->faker->randomElement([
                '흰색', '회색', '검정색', '삼색', '턱시도', '고등어', '치즈'
            ]),
            'role' => $this->faker->randomElement(['멘토','멘티']),
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
