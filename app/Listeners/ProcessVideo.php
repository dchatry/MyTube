<?php

namespace App\Listeners;

use App\Jobs\DownloadVideoJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
