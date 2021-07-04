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
        // password = laser123
        $date = now();
        $date = $date->format('Y-m-d');

        User::create(
            [
                'name' => 'Admin',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'admin@gmail.com',
                'tc' => '11111111111',
                'phone' => '1111111111',
                'email_verified_at' => now(),
                'recruitment_date' => $date,

            ]
        )->syncRoles('Admin');

        User::create(
            [
                'name' => 'uzman1',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'uzman1@gmail.com',
                'tc' => '111',
                'phone' => '111',
                'job_id' => 1,
                'email_verified_at' => now(),
                'recruitment_date' => $date,


            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'd',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'doktor@gmail.com',
                'tc' => '444',
                'phone' => '444',
                'job_id' => 4,
                'email_verified_at' => now(),
                'recruitment_date' => $date,


            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'CompAdmin',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'compadmin@gmail.com',
                'tc' => '888',
                'phone' => '888',
                'email_verified_at' => now(),
                'recruitment_date' => $date,


            ]
        )->syncRoles('CompanyAdmin');
    }
}
