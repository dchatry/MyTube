<?php

namespace App\Providers;

use App\Events\SubscriptionDeleted;
use App\Events\VideoCreated;
use App\Events\VideoDeleted;
use App\Listeners\DeleteSubscriptionVideos;
use App\Listeners\DeleteVideoFiles;
use App\Listeners\ProcessVideo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        VideoCreated::class => [
            ProcessVideo::class,
        ],
        VideoDeleted::class => [
            DeleteVideoFiles::class,
        ],
        SubscriptionDeleted::class => [
            DeleteSubscriptionVideos::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
