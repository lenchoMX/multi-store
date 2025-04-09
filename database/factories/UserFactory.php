<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'given_name' => fake()->word(),
            'family_name' => fake()->word(),
            'additional_name' => fake()->word(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'password' => fake()->password(),
            'risk_level' => fake()->randomElement(["low","medium","high"]),
            'trust_score' => fake()->numberBetween(-10000, 10000),
            'last_risk_update' => fake()->dateTime(),
        ];
    }
}
