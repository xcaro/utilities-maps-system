<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use r;

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
        $r_connect = r\connect(env('R_HOST'), env('R_PORT'));

        $result = \App\Clinic::whereDate('end_date', '<', Carbon::today())
                     ->get()->map(function($item) use ($r_connect) {
                        r\db('app')->table('activeClinics')->get((int)$item['id'])->delete()->run($r_connect);
                        return $item['id'];
                     });
                     \App\Clinic::whereIn('id', $result)->update(['active' => false]);
        $r_connect->close();
    }
}
