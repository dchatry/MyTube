<?php

namespace App\Models;

use App\Events\VideoCreated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use Prunable;

    protected $fillable = [
        'subscription_id',
        'identifier',
        'title',
        'description',
        'duration',
        'processed_at',
        'published_at',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => VideoCreated::class,
    ];

    public function prunable(): Builder
    {
        return static::where('published_at', '<=', now()->subWeeks(2));
    }

    protected function pruning(): void
    {
        Storage::disk('videos')->deleteDirectory($this->identifier);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    protected function getVideoFilePathAttribute(): string
    {
        return asset("storage/videos/{$this->identifier}/{$this->identifier}.mp4");
    }

    protected function getThumbnailFilePathAttribute(): string
    {
        return asset("storage/videos/{$this->identifier}/{$this->identifier}.webp");
    }

    public function scopeLastPublished(Builder $query): void
    {
        $query->orderByDesc('published_at');
    }

    public function scopeProcessed(Builder $query): void
    {
        $query->whereNotNull('processed_at');
    }
}
