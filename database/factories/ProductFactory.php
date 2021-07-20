<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

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
            'sku' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'name' => $this->faker->name,
            'barcode' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'brand_id' => $this->faker->word,
            'temporary' => $this->faker->boolean,
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'status' => $this->faker->boolean,
            'type' => $this->faker->randomElement(["servicio","producto"]),
        ];
    }
}
