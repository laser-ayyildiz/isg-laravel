<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            JobSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            //CompanySeeder::class,
            //CoopEmployeeSeeder::class,
            //UserToCompanySeeder::class,
            CompanyFileTypeSeeder::class,
            EmployeeEducationTypeSeeder::class,
        ]);
    }
}
