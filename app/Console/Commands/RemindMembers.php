<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Notifications\RemindMembersNotification;
use Illuminate\Support\Facades\Notification;
class RemindMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind members who has not booked the Class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = User::where('role','=','member')
                ->whereDoesntHave('bookings',function($query){
                 $query->where('date_time','>',now());
                })->select('name','email')->get();
        // $this->table(
        //     ['name','email'],
        //     $members->toArray()
        // );
        Notification::send($members, new RemindMembersNotification);
    }
}
