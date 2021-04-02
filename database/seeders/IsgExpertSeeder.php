<?php

namespace Database\Seeders;

use App\Models\IsgExpert;
use Illuminate\Database\Seeder;

class IsgExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IsgExpert::factory()->times(20)->create();
    }
}
