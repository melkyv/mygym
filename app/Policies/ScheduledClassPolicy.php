<?php

namespace App\Policies;

use App\Models\ScheduledClass;
use App\Models\User;

class ScheduledClassPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(User $user, ScheduledClass $scheduledClass)
    {
        return $user->id === $scheduledClass->instructor_id
        && $scheduledClass->date_time > now()->addHours(2);
    }
}
