<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Choice extends Model
{
    use HasUlids;

    protected $fillable = [
        'passage_id',
        'destination_passage_id',
        'label',
        'condition_requirement',
        'order',
    ];

    protected $casts = [
        'condition_requirement' => 'array',
        'order' => 'integer',
    ];

    public function passage(): BelongsTo
    {
        return $this->belongsTo(Passage::class);
    }

    public function destinationPassage(): BelongsTo
    {
        return $this->belongsTo(Passage::class, 'destination_passage_id');
    }
}
