<?php

namespace Database\Seeders;

use App\Models\Accountant;
use Illuminate\Database\Seeder;

class AccountantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Accountant::factory()->times(20)->create();
    }
}
