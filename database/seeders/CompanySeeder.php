<?php

namespace Database\Seeders;

use App\Models\CoopCompany;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoopCompany::factory()->times(5)->create();
    }
}
