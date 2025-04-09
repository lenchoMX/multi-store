<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Discount;
use App\Models\Store;

class DiscountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discount::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'type' => fake()->randomElement(["percentage","fixed"]),
            'value' => fake()->randomFloat(2, 0, 999999.99),
            'start_date' => fake()->dateTime(),
            'end_date' => fake()->dateTime(),
            'is_active' => fake()->boolean(),
        ];
    }
}
