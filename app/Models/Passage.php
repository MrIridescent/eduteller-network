<?php

namespace App\Models;

use App\Enums\NarrativeStage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Passage extends Model
{
    use HasUlids;

    protected $fillable = [
        'story_id',
        'title',
        'content',
        'stage',
        'is_start',
        'is_end',
        'metadata',
        'content_type',
        'content_id',
    ];

    protected $casts = [
        'stage' => NarrativeStage::class,
        'metadata' => 'array',
        'is_start' => 'boolean',
        'is_end' => 'boolean',
    ];

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }

    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }

    /**
     * Polymorphic relationship to specific content (Quiz, Video, Interactive Map)
     */
    public function contentable(): MorphTo
    {
        return $this->morphTo('content');
    }
}
