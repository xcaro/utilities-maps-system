<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ClinicDisable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clinic:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto disable expired clinics';

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
     * @return mixed
     */
    public function handle()
    {
        \App\Clinic::whereDate('end_date', '<', Carbon::today())
                     ->update(['active' => false]);
    }
}
