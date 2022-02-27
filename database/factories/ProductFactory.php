<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_uuid' => Category::inRandomOrder()->pluck('uuid')->first(),
            'uuid' => $this->faker->uuid(),
            'title' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 1, 99),
            'description' => $this->faker->sentence(),
            'metadata' => json_encode([
                'image' => null,
                'brand' => Brand::inRandomOrder()->pluck('uuid')->first(),
            ])
        ];
    }
}
