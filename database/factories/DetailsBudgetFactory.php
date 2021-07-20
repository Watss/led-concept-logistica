<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Budget;
use App\Models\DetailsBudget;
use App\Models\Product;

class DetailsBudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailsBudget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'budget_id' => Budget::factory(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'product_price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'product_sku' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'total' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
