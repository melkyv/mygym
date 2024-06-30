<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use App\Mail\ClassCanceledMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyClassCanceled
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

        $details = compact('className', 'classDateTime');

        $members->each(function ($member) use ($details){
            Mail::to($member)->send(new ClassCanceledMail($details));
        });
    }
}
