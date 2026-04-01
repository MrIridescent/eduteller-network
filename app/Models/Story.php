<?php

namespace App\Models;

use App\Enums\StoryState;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Story extends Model
{
    use HasUlids;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'state',
        'author_id',
    ];

    protected $casts = [
        'state' => StoryState::class,
    ];

    public function passages(): HasMany
    {
        return $this->hasMany(Passage::class);
    }

    public function initialPassage(): HasOne
    {
        return $this->hasOne(Passage::class)->where('is_start', true);
    }
}
