<?php

namespace Database\Factories;

use App\Models\CoopCompanies;
use App\Models\CoopEmployees;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CoopEmployeesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoopEmployees::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $count = CoopCompanies::count();
        return [
            'company_id' => random_int(1, $count),
            'firstname' => $this->faker->name,
            'lastname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->tollFreePhoneNumber,
            'tc' => random_int(10000000, 9999999999),
            'position' => $this->faker->word,
            'deleted' => random_int(0, 1),
            'contract_at' => $this->faker->dateTime($max = 'now'),
        ];
    }
}
