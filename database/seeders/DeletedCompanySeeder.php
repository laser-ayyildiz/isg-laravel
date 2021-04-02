<?php

namespace Database\Seeders;

use App\Models\DeletedCompany;
use Illuminate\Database\Seeder;

class DeletedCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeletedCompany::factory()->times(200)->create();
    }
}
