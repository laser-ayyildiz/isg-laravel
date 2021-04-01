<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\HealthStaffs;
use Illuminate\Database\Eloquent\Factories\Factory;

class HealthStaffsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HealthStaffs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = User::count();
        return [
            'user_id' => random_int(1, $user_id - 1),
        ];
    }
}
