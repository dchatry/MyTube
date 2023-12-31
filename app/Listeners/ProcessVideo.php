<?php

namespace App\Listeners;

use App\Jobs\DownloadVideoJob;

class ProcessVideo
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
        DownloadVideoJob::dispatch($event->video);
    }
}
