<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ScheduledClass;

class ScheduledClassPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    Public function delete(User $user,ScheduledClass $scheduledClass){
        return $user->id === $scheduledClass->instructor_id
        &&   now()->addHours(2)->minutes(0)->seconds(0)  < $scheduledClass->date_time;

    }
}
