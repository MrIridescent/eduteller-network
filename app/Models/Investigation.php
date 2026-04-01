<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Investigation extends Model
{
    use HasUlids;

    protected $fillable = [
        'school_id',
        'strategist_id',
        'investigation_date',
        'culture_score',
        'safety_score',
        'nurture_score',
        'summary_report',
        'raw_findings',
    ];

    protected $casts = [
        'investigation_date' => 'date',
        'culture_score' => 'integer',
        'safety_score' => 'integer',
        'nurture_score' => 'integer',
        'raw_findings' => 'array',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function strategist(): BelongsTo
    {
        return $this->belongsTo(User::class, 'strategist_id');
    }
}
