<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfficeStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\OfficeStaffs::factory()->times(20)->create();
    }
}
