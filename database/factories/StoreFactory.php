<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Currency;
use App\Models\Store;
use App\Models\Theme;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'store_url' => fake()->word(),
            'email' => fake()->safeEmail(),
            'whatsapp' => fake()->word(),
            'theme_id' => Theme::factory(),
            'currency_id' => Currency::factory(),
            'settings' => '{}',
        ];
    }
}
