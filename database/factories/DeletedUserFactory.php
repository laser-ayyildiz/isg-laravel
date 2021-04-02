<?php

namespace Database\Factories;

use App\Models\DeletedUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeletedUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeletedUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->name,
            'lastname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'auth_type' => random_int(0, 9),
            'recruitment_date' => $this->faker->date,
            'tc' => $this->faker->e164PhoneNumber,
            'phone' => $this->faker->e164PhoneNumber,
        ];
    }
}
