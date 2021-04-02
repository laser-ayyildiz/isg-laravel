<?php

namespace Database\Seeders;

use App\Models\CoopEmployee;
use Illuminate\Database\Seeder;

class CoopEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoopEmployee::factory()->times(200)->create();
    }
}
