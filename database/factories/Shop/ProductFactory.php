<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Product;
use Database\Seeders\LocalImages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class ProductFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->catchPhrase(),
            'slug' => Str::slug($name),
            'sku' => $this->faker->unique()->ean8(),
            'description' => $this->faker->realText(),
            'qty' => $this->faker->randomDigitNotNull(),
            'security_stock' => $this->faker->randomDigitNotNull(),
            'featured' => $this->faker->boolean(),
            'is_visible' => $this->faker->boolean(),
            'small_price_discount' => $this->faker->numberBetween($min=1, $max=100),
            'medium_price_discount' => $this->faker->numberBetween($min=1, $max=100),
            'large_price_discount' => $this->faker->numberBetween($min=1, $max=100),
            'small_price' => $this->faker->randomFloat(2, 80, 400),
            'medium_price' => $this->faker->randomFloat(2, 80, 400),
            'large_price' => $this->faker->randomFloat(2, 80, 400),
            'cost' => $this->faker->randomFloat(2, 50, 200),
            'type' => $this->faker->randomElement(['deliverable', 'downloadable']),
            'published_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }

    public function configure(): ProductFactory
    {
        return $this->afterCreating(function (Product $product) {
            try {
                $product
                    ->addMedia(LocalImages::getRandomFile())
                    ->preservingOriginal()
                    ->toMediaCollection('product-images');
            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
