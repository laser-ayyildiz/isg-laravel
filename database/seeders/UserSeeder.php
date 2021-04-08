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
            ]
        )->syncRoles('Admin');

        User::create(
            [
                'name' => 'İsg Uzmanı 1',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'uzman1@gmail.com',
                'tc' => '111',
                'phone' => '111',
            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'İsg Uzmanı 2',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'uzman2@gmail.com',
                'tc' => '222',
                'phone' => '222',
            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'İsg Uzmanı 3',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'uzman3@gmail.com',
                'tc' => '333',
                'phone' => '333',
            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'Doktor',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'doktor@gmail.com',
                'tc' => '444',
                'phone' => '444',
            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'Sağlık Personeli',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'saglik@gmail.com',
                'tc' => '555',
                'phone' => '555',
            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'Ofis Personeli',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'ofis@gmail.com',
                'tc' => '666',
                'phone' => '666',
            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'Muhasebeci',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'muhasebe@gmail.com',
                'tc' => '777',
                'phone' => '777',
            ]
        )->syncRoles('User');

        User::create(
            [
                'name' => 'CompAdmin',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'compadmin@gmail.com',
                'tc' => '888',
                'phone' => '888',
            ]
        )->syncRoles('CompanyAdmin');

        User::create(
            [
                'name' => 'CompUser',
                'password' => '$2y$10$Dxxw9F77BWu3UMByi6XtguPanObmSuxSdZbegJwvz0i8/0reM0pli',
                'email' => 'compuser@gmail.com',
                'tc' => '999',
                'phone' => '999',
            ]
        )->syncRoles('CompanyUser');

        User::factory()->times(20)->create();
    }
}
