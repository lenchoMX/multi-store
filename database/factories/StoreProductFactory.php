<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Currency;
use App\Models\Description;
use App\Models\Image;
use App\Models\PrimaryCategoryStore;
use App\Models\Product;
use App\Models\ShortDescription;
use App\Models\Store;
use App\Models\StoreProduct;

class StoreProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreProduct::class;

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
            'price' => fake()->randomFloat(2, 0, 999999.99),
            'currency_id' => Currency::factory(),
            'stock' => fake()->numberBetween(-10000, 10000),
            'is_active' => fake()->boolean(),
            'view' => fake()->numberBetween(-10000, 10000),
            'rating_value' => fake()->randomFloat(1, 0, 99.9),
            'review_count' => fake()->numberBetween(-10000, 10000),
            'comment_count' => fake()->numberBetween(-10000, 10000),
            'primary_category_store_id' => PrimaryCategoryStore::factory(),
        ];
    }
}
