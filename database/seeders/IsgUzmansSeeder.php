<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IsgUzmansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\IsgUzmans::factory()->times(20)->create();
    }
}
