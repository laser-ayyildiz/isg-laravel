<?php

namespace App\Console\Commands;

use DateTime;
use App\Models\CoopEmployee;
use App\Models\UserToCompany;
use App\Notifications\ValidationOutOfDate;
use Illuminate\Console\Command;

class ValidDateControl extends Command
{
    const FILE_TYPES = [
        1 => 'first_edu',
        2 => 'second_edu',
        3 => 'examination',
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'control:valid_date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Control Coop Employees' files' valid dates and change relational columns values";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $time_start = microtime(true);
        $this->info('Comparing Started!');

        $employees = CoopEmployee::with('files')->get();
        $arr = [];
        $file_types = [
            1 => 'first_edu',
            2 => 'second_edu',
            3 => 'examination',
        ];
        $bar = $this->output->createProgressBar(count($employees));
        $bar->start();
        foreach ($employees as $employee) {
            $arr[$employee->id] = ['first_edu' => 0, 'second_edu' => 0, 'examination' => 0];
            foreach ($employee->files->whereIn('file_type', [1, 2, 3]) as $file) {
                $date = new DateTime($file->valid_date);
                $valid_date = $date->modify('-1 month')->format('Y-m-d') > date("Y-m-d");
                $type = $file_types[$file->file_type];
                if ($valid_date)
                    $arr[$employee->id][$type] = 1;
            }
            $bar->advance();
        }
        $bar->finish();
        $this->newLine();
        $this->info('Update started!');
        foreach ($arr as $key => $value) {
            $emp = $employees->where('id', $key)->first();
            $empValues = $emp->only(['first_edu', 'second_edu', 'examination']);
            if ($empValues !== $value) {
                try {
                    $emp->update(
                        [
                            'first_edu' => $value['first_edu'],
                            'second_edu' => $value['second_edu'],
                            'examination' => $value['examination']
                        ]
                    );
                    $this->info('Updated employee id = ' . $key);

                    ///////////////////////////////////////////////////////////////////////////

                    $changedValues = array_diff_assoc($empValues, $value);
                    if ($changedValues !== null) {
                        $delay = now()->addMinutes(1);
                        $willNotifyUsers = UserToCompany::with('user')->where('company_id', $emp->company_id)->whereHas('user', function ($query) {
                            $query->whereIn('job_id', [1, 4]);
                        })->get();
                        foreach ($willNotifyUsers->unique('user_id') as $user) {
                            $user->user->notify((new ValidationOutOfDate($emp, $changedValues))->delay($delay));
                            $this->line('Notified user id = ' . $user->user->id);
                        }
                    }
                } catch (\Throwable $th) {
                    $this->error('Update Failed id=' . $key);
                    continue;
                }
                sleep(1);
            }
        }
        $this->info('Updated all rows successfully!');

        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);
        $this->info('Total Execution Time: ' . ($execution_time) . ' seconds');
    }
}
