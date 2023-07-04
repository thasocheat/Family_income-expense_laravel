<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $faker = Faker::Generator;
        return [
            // "income_category_id" => Income::factory('App\IncomeCategory')->create(),
            // "entry_date" => $faker->date("Y-m-d", $max = 'now'),
            // "amount" => $faker->name,
            // "created_by_id" => Income::factory('App\User')->create(),
        ];
    }
}
