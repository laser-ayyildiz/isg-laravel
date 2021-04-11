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

        User::create(
            [
                'name' => 'Admin',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'admin@gmail.com',
                'tc' => '11111111111',
                'phone' => '1111111111',
                'email_verified_at' => now(),

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

            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'uzman2',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'uzman2@gmail.com',
                'tc' => '222',
                'phone' => '222',
                'job_id' => 2,
                'email_verified_at' => now(),

            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'uzman3',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'uzman3@gmail.com',
                'tc' => '333',
                'phone' => '333',
                'job_id' => 3,
                'email_verified_at' => now(),


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

            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'sp',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'saglik@gmail.com',
                'tc' => '555',
                'phone' => '555',
                'job_id' => 5,
                'email_verified_at' => now(),

            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'op',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'ofis@gmail.com',
                'tc' => '666',
                'phone' => '666',
                'job_id' => 6,
                'email_verified_at' => now(),

            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'm',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'muhasebe@gmail.com',
                'tc' => '777',
                'phone' => '777',
                'job_id' => 7,
                'email_verified_at' => now(),

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

            ]
        )->syncRoles('CompanyAdmin');

        User::create(
            [
                'name' => 'CompUser',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'compuser@gmail.com',
                'tc' => '999',
                'phone' => '999',
                'email_verified_at' => now(),
            ]
        )->syncRoles('CompanyUser');

        User::factory()->times(20)->create();
    }
}
