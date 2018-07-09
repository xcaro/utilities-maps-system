<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use r;

class ReportDisable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:disable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable report after a time';

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
        
        $now = Carbon::now();
        $list_types = \App\ReportType::where('active', true)
                                       ->where('alive', '!=', 0)->get();
        foreach ($list_types as $type) {
            $result = \App\Report::where('active', true)
                         ->where('type_id', $type->id)
                         ->whereDate('created_at', '<', $now->subSeconds($type->alive))
                         ->get()->map(function($item) use ($r_connect){
                            r\db('app')->table('activeReports')->get((int)$item['id'])->delete()->run($r_connect);
                            return $item['id'];
                         });
                         //->update(['active' => false]);
            \App\Report::whereIn('id', $result)->update(['active' => false]);

        }

        $r_connect->close();
    }
}
