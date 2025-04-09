<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Store;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => fake()->word(),
            'store_id' => Store::factory(),
            'type' => fake()->randomElement(["percentage","fixed"]),
            'value' => fake()->randomFloat(2, 0, 999999.99),
            'usage_limit' => fake()->numberBetween(-10000, 10000),
            'start_date' => fake()->dateTime(),
            'end_date' => fake()->dateTime(),
            'is_active' => fake()->boolean(),
        ];
    }
}
