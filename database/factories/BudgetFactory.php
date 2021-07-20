<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Budget;
use App\Models\Client;
use App\Models\User;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'neto' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'iva' => $this->faker->randomFloat(0, 0, 9999999999.),
            'total' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'reference' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'client_id' => Client::factory(),
            'user_id' => User::factory(),
        ];
    }
}
