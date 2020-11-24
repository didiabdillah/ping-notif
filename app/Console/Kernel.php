<?php

namespace App\Console;

use Carbon\Carbon;
use Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
     
        $schedule->call(function () 
        {
            $wa =   DB::table('wa_account')->where('status','aktif')->select('id','user_id')->get();
            foreach ($wa as $key) 
            {
                $dt         =Helpers::MasaAkit($key->id);
                $dt_hist    =DB::table('history_billing')
                            ->select('id_his_bill')
                            ->where('id_wa',$key->id)
                            ->where('id_user',$key->user_id)
                            ->where('status','pending')
                            ->where('status_akses','kredit')
                            ->first();
                $masa_aktif =$dt['hari'];
                if(intval($masa_aktif)<=2&&!$dt_hist)
                {
                    Helpers::create_paket($key->id,$key->user_id);
                }
            } 

        })->daily();

        $schedule->call(function () 
        {
            
        })->everyThirtyMinutes();
    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
