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
        Job::create(['name' => 'İsg Uzmanı']);
        Job::create(['name' => 'İsg Uzmanı']);
        Job::create(['name' => 'İsg Uzmanı']);
        Job::create(['name' => 'İş Yeri Hekimi']);
        Job::create(['name' => 'Diğer Sağlık Personeli']);
        Job::create(['name' => 'Ofis Personeli']);
        Job::create(['name' => 'Muhasebeci']);
        Job::create(['name' => 'Şirket Çalışanı']);
    }
}
