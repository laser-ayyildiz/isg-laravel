<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\CoopCompany;
use App\Models\UserToCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserToCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserToCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $employee_count = User::count();
        $company_count = CoopCompany::count();

        return [
            'user_id' => random_int(1, $employee_count - 1),
            'company_id' => random_int(1, $company_count - 1)
        ];
    }
}
