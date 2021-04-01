<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserToCompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserToCompanies::factory()->times(200)->create();
    }
}
