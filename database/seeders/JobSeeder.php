<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::create(['name' => 'İsg Uzmanı 1']);
        Job::create(['name' => 'İsg Uzmanı 2']);
        Job::create(['name' => 'İsg Uzmanı 3']);
        Job::create(['name' => 'Doktor']);
        Job::create(['name' => 'Sağlık Personeli']);
        Job::create(['name' => 'Ofis Personeli']);
        Job::create(['name' => 'Muhasebeci']);
    }
}
