<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class DownloadVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Video $video)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $result = Process::timeout(120)
            ->path(Storage::disk('videos')->path('/'))
            ->run(config('downloader.path') . " -f best -ciw --write-description --write-thumbnail {$this->video->identifier} -o '{$this->video->identifier}/{$this->video->identifier}.%(ext)s'");

        if (! Storage::disk('videos')->exists("{$this->video->identifier}/{$this->video->identifier}.mp4")) {
            throw new \Exception("Unable to download {$this->video->title}: {$result->errorOutput()}.");
        }

        $this->video->update([
            'description' => Storage::disk('videos')->get("{$this->video->identifier}/{$this->video->identifier}.description"),
            'size' => Storage::disk('videos')->size("{$this->video->identifier}/{$this->video->identifier}.mp4"),
            'processed_at' => now(),
        ]);
    }
}
