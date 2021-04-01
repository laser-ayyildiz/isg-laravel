<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoopEmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CoopEmployees::factory()->times(2000)->create();
    }
}
