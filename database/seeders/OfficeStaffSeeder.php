<?php

namespace Database\Seeders;

use App\Models\OfficeStaff;
use Illuminate\Database\Seeder;

class OfficeStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OfficeStaff::factory()->times(20)->create();
    }
}
