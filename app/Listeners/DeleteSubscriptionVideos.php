<?php

namespace App\Listeners;

class DeleteSubscriptionVideos
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
        $event->subscription->videos->each->delete();
    }
}
