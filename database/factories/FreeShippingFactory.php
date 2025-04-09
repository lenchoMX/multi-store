<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\FreeShipping;
use App\Models\Store;

class FreeShippingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FreeShipping::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'min_order_amount' => fake()->randomFloat(2, 0, 999999.99),
            'start_date' => fake()->dateTime(),
            'end_date' => fake()->dateTime(),
            'is_active' => fake()->boolean(),
        ];
    }
}
