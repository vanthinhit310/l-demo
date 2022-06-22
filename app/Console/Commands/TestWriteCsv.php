<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use League\Csv\Writer;
use League\Csv\CannotInsertRecord;

class TestWriteCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'write:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        try {
            $writer = Writer::createFromPath(storage_path("app/public/demo.csv"), 'w+');
            $writer->insertOne(['ID', 'NAME', 'EMAIL', 'EMAIL_VERIFIED_AT', 'PASSWORD', 'REMEMBER_TOKEN', 'CREATED_AT', 'UPDATED_AT']);
            foreach (User::get() as $user) {
                $writer->insertOne([
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->email_verified_at,
                    $user->password,
                    $user->remember_token,
                    Carbon::parse($user->created_at)->format("d/m/Y H:i:s"),
                    Carbon::parse($user->updated_at)->format("d/m/Y H:i:s")
                ]);
            }
        } catch (CannotInsertRecord $e) {
            Log::debug("Records", $e->getRecords());
        }

        $this->info('Total execution time in seconds: ' . (microtime(true) - $time_start));
    }
}
