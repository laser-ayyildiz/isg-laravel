<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\OsgbEmployee;
use Illuminate\Database\Eloquent\Factories\Factory;


class OsgbEmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OsgbEmployee::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $count = User::count();
        $emails = User::get(['email'])->toArray();

        return [
            'user_type' => $this->faker->word,
            'firstname' => $this->faker->name,
            'lastname' => $this->faker->name,
            'email' => $emails[random_int(0, $count - 1)]["email"],
            'phone' => $this->faker->tollFreePhoneNumber,
            'tc' => random_int(10000000, 9999999999),
            'deleted' => random_int(0, 1),
            'worker_text' => $this->faker->paragraph(),
            'start_at' => $this->faker->dateTime($max = 'now'),
        ];
    }
}
