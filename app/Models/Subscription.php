<?php

namespace App\Models;

use App\Events\SubscriptionDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'deleted' => SubscriptionDeleted::class,
    ];

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
