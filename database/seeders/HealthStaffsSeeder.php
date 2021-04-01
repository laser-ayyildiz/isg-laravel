<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HealthStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\HealthStaffs::factory()->times(20)->create();
    }
}
