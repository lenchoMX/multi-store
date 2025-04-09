<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderStatus;
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
            'store_id' => Store::factory(),
            'user_id' => User::factory(),
            'shipping_address_id' => Address::factory(),
            'coupon_id' => Coupon::factory(),
            'order_number' => fake()->word(),
            'order_date' => fake()->dateTime(),
            'total_amount' => fake()->randomFloat(2, 0, 999999.99),
            'order_status_id' => OrderStatus::factory(),
            'guest_name' => fake()->word(),
            'guest_email' => fake()->word(),
            'guest_phone' => fake()->word(),
        ];
    }
}
