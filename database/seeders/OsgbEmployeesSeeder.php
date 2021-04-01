<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OsgbEmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\OsgbEmployees::factory()->times(20)->create();
    }
}
