<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Store;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'store_id' => Store::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'address' => $this->faker->word(),
            'total' => $this->faker->randomFloat(2, 0, 999999.99),
            'status' => $this->faker->randomElement(["pending","payment_pending","completed","cancelled"]),
        ];
    }
}
