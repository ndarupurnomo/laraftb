<?php

namespace App\Console;

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
        // Commands\Inspire::class,
        // Commands\SaveSearch::class,
        Commands\TopicTweet::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('topic:tweet')
                 ->everyThirtyMinutes();
        // $schedule->command('inspire')
        //          ->hourly();
        // add this to chron: * * * * * php /home/vagrant/htdocs/laraftb/artisan schedule:run 1>> /dev/null 2>&1
    }
}
