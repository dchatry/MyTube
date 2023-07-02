<?php

namespace App\Console\Commands;

use App\Jobs\RefreshSubscriptionJob;
use App\Models\Subscription;
use Illuminate\Console\Command;

class RefreshSubscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:refresh {subscription?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh subscriptions videos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->argument('subscription')) {
            RefreshSubscriptionJob::dispatch($this->argument('subscription'));
            return;
        }

        Subscription::cursor()->each(function (Subscription $subscription) {
            $this->info("{$subscription->title} job launched!");
            RefreshSubscriptionJob::dispatch($subscription);
        });
    }
}
