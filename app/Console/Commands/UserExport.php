<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPodcast;
use App\Models\User;
use Illuminate\Console\Command;
use Rap2hpoutre\FastExcel\FastExcel;

class UserExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to export large user';

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

        // (new FastExcel(User::all()))->export(
        //     storage_path("app/public/users.csv"),
        //     function ($user) {
        //         return [
        //             'Id' => $user->id,
        //             'Name' => $user->name,
        //             'Email' => $user->email,
        //             'Email Verified At' => $user->email_verified_at,
        //             'Password' => $user->password,
        //             'Remember Token' => $user->remember_token,
        //             'Created At' => $user->created_at,
        //             'Updated At' => $user->updated_at,
        //         ];
        //     }
        // );
        for ($i = 0; $i < 1000; $i++) {
            ProcessPodcast::dispatch($i)->delay(now()->addSecond(2));
        }
        $this->info('Total execution time in seconds: ' . (microtime(true) - $time_start));
    }
}
