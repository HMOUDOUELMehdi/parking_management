<?php

namespace App\Listeners;

use App\Events\fireEvent;
use App\Notifications\RegisterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class fireListener
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
    public function handle(object $event): void
    {
        $event->user->notify(new RegisterNotification());
    }
}
