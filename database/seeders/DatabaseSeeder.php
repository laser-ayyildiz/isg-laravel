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
            UserSeeder::class,
            CompanySeeder::class,
            CoopEmployeeSeeder::class,
            UserToCompanySeeder::class,
            IsgExpertSeeder::class,
            DoctorSeeder::class,
            OfficeStaffSeeder::class,
            HealthStaffSeeder::class,
            AccountantSeeder::class,
            //DeletedCompanySeeder::class,
            //DeletedUserSeeder::class
        ]);
    }
}
