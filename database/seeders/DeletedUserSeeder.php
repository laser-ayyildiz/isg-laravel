<?php

namespace Database\Seeders;

use App\Models\DeletedUser;
use Illuminate\Database\Seeder;

class DeletedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeletedUser::factory()->times(200)->create();
    }
}
