<?php

namespace Database\Factories;

use App\Models\DeletedCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeletedCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeletedCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->tollFreePhoneNumber,
            'employer' => $this->faker->name,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'town' => $this->faker->city,
            'contract_at' => $this->faker->dateTime($max = 'now'),
            'nace_kodu' => random_int(100, 999),
            'mersis_no' => random_int(100, 999),
            'sgk_sicil' => random_int(100, 999),
            'vergi_no' => random_int(100, 999),
            'vergi_dairesi' => $this->faker->city,
            'nace_kodu' => random_int(100, 999),
            'katip_is_yeri_id' => random_int(100, 999),
            'katip_kurum_id' => random_int(100, 999),
        ];
    }
}
