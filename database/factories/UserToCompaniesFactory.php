<?php

namespace Database\Factories;

use App\Models\UserToCompanies;
use App\Models\CoopCompanies;
use App\Models\OsgbEmployees;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserToCompaniesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserToCompanies::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $employee_count = OsgbEmployees::count();
        $company_count = CoopCompanies::count();

        return [
            'user_id' => random_int(1, $employee_count - 1),
            'company_id' => random_int(1, $company_count - 1)
        ];
    }
}
