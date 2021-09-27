<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Type;

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
            'sku' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'name' => $this->faker->name,
            'barcode' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'brand_id' => $this->faker->word,
            'temporary' => $this->faker->boolean,
            'price' => 20000,
            'status' => $this->faker->boolean,
            'type_id' => Type::factory()
        ];
    }
}
