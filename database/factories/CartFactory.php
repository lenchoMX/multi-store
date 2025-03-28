<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\ProductStore;
use App\Models\User;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'session_id' => $this->faker->word(),
            'user_id' => User::factory(),
            'product_store_id' => ProductStore::factory(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->randomElement(["pending","checkout","abandoned","completed"]),
            'abandoned_at' => $this->faker->dateTime(),
        ];
    }
}
