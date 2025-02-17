<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ClassCanceledMail;

class NotifyClassCancelled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassCanceled $event): void
    {
        
        $members = $event->scheduledClass->members();
        $className = $event->scheduledClass->classType->name;
        $classDateTime = $event->scheduledClass->date_time;
        $details = compact('className','classDateTime'); 
        $members->each(function($user) use ($details){
            Log::info($user);
            mail::to($user)->send(new ClassCanceledMail($details));
        } );
        // Log::info($scheduledClass);
    }
}
