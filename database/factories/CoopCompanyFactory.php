<?php

namespace Database\Factories;

use App\Models\CoopCompany;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CoopCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoopCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->word(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->tollFreePhoneNumber(),
            'employer' => $this->faker->name(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'town' => $this->faker->city(),
            'danger_type' => random_int(1,3),
            'contract_at' => $this->faker->dateTime($max = 'now'),
            'nace_kodu' => random_int(100, 9999999),
            'mersis_no' => random_int(100, 9999999),
            'sgk_sicil' => random_int(100, 9999999),
            'vergi_no' => random_int(100, 9999999),
            'vergi_dairesi' => $this->faker->city(),
            'nace_kodu' => random_int(100, 999),
            'katip_is_yeri_id' => random_int(100, 999),
            'katip_kurum_id' => random_int(100, 999)
        ];
    }
}
