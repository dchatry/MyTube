<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class RefreshSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Subscription $subscription)
    {
    }

    /**
     * Execute the job.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        $response = Http::get("https://www.youtube.com/feeds/videos.xml?channel_id={$this->subscription->identifier}");

        if (! $response->ok()) {
            report("Unable to fetch {$this->subscription->title} feed");

            return;
        }

        $feed = new SimpleXMLElement($response->body());

        foreach ($feed->entry as $entry) {
            if (Carbon::parse($entry->published) < now()->subWeek()) {
                continue;
            }

            Video::updateOrCreate([
                'identifier' => str($entry->id)->afterLast(':')->toString(),
            ], [
                'title' => $entry->title,
                'subscription_id' => $this->subscription->id,
                'published_at' => $entry->published,
            ]);
        }
    }
}
