<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Checkout;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'checkout_id' => Checkout::factory(),
            'postal_code' => fake()->postcode(),
            'address_line_1' => fake()->word(),
            'address_line_2' => fake()->word(),
            'reference' => fake()->word(),
            'type' => fake()->randomElement(["sepomex","standard"]),
        ];
    }
}
