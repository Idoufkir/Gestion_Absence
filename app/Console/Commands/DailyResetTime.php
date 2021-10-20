<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DailyResetTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:resetTime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'daily reset time Login User';

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
        $rows = User::where('day_login_at', '!=', Null)->get();
        foreach($rows as $row) {
            $row->day_login_at = Null;
            $row->save();
        }

        return Command::SUCCESS;
    }
}
