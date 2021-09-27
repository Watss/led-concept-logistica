<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Budget;
use App\Models\BudgetStatus;
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
            'neto' => $this->faker->numberBetween(10000, 100000),
            'iva' => $this->faker->numberBetween(10000, 100000),
            'total' => $this->faker->numberBetween(10000, 100000),
            'reference' => $this->faker->paragraph(2),
            'client_id' => Client::factory(),
            'user_id' => User::factory(),
            'budget_statuses_id' => BudgetStatus::factory()
        ];
    }
}
