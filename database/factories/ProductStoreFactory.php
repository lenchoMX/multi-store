<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CategoryStore;
use App\Models\Currency;
use App\Models\Description;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductStore;
use App\Models\ShortDescription;
use App\Models\Store;

class ProductStoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductStore::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'product_id' => Product::factory(),
            'image_id' => Image::factory(),
            'description_id' => Description::factory(),
            'short_description_id' => ShortDescription::factory(),
            'status' => $this->faker->randomElement(["available","out"]),
            'price' => $this->faker->randomFloat(2, 0, 999999.99),
            'currency_id' => Currency::factory(),
            'stock' => $this->faker->randomNumber(),
            'view' => $this->faker->randomNumber(),
            'rating_value' => $this->faker->randomNumber(),
            'review_count' => $this->faker->randomNumber(),
            'comment_count' => $this->faker->randomNumber(),
            'primary_category_store_id' => CategoryStore::factory(),
        ];
    }
}
