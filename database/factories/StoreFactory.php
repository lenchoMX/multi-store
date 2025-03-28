<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
            'name' => $this->faker->name(),
            'store_url' => $this->faker->word(),
            'email' => $this->faker->safeEmail(),
            'whatsapp' => $this->faker->word(),
            'theme_id' => Theme::factory(),
        ];
    }
}
