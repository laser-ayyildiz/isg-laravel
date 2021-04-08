<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\UserHasJob;
use Illuminate\Database\Seeder;

class UserHasJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserHasJob::create(
            [
                'user_id' => 2,
                'job_id' => 1,
            ]

        );
        UserHasJob::create(
            [
                'user_id' => 3,
                'job_id' => 2,
            ]

        );
        UserHasJob::create(
            [
                'user_id' => 4,
                'job_id' => 3,
            ]

        );
        UserHasJob::create(
            [
                'user_id' => 5,
                'job_id' => 4,
            ]

        );
        UserHasJob::create(
            [
                'user_id' => 6,
                'job_id' => 5,
            ]

        );
        UserHasJob::create(
            [
                'user_id' => 7,
                'job_id' => 6,
            ]

        );
        UserHasJob::create(
            [
                'user_id' => 8,
                'job_id' => 7,
            ]

        );
    }
}
