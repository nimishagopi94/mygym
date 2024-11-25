<?php

namespace App\Console\Commands;
use App\Models\ScheduledClass;

use Illuminate\Console\Command;

class IncrementDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increment-date {--days=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'increment all scheduled class Days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $scheduledClass = ScheduledClass::latest('date_time')->get();
        $scheduledClass->each( function($class){
            $class->date_time = $class->date_time->addDays(intval($this->option('days')));
            $class->save();
            
        });
    }
}
