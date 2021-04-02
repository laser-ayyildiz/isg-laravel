<?php

namespace Database\Seeders;

use App\Models\HealthStaff;
use Illuminate\Database\Seeder;

class HealthStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HealthStaff::factory()->times(20)->create();
    }
}
