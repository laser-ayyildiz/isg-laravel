<?php

namespace Database\Seeders;

use App\Models\UserToCompany;
use Illuminate\Database\Seeder;

class UserToCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserToCompany::factory()->times(200)->create();
    }
}
