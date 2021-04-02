<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'auth_type' => 10,
            'name' => 'Laser Ayyıldız',
            'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
            'email' => 'laserayyildiz@gmail.com',
            'tc' => '11111111111',
            'phone' => '1111111111',
        ]);

        User::factory()->times(200)->create();
    }
}
