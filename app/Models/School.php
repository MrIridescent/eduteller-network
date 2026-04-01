<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasUlids;

    protected $fillable = [
        'name',
        'slug',
        'location',
        'fee_range_min',
        'fee_range_max',
        'attributes',
        'facilities',
        'mission_statement',
    ];

    protected $casts = [
        'attributes' => 'array',
        'facilities' => 'array',
        'fee_range_min' => 'decimal:2',
        'fee_range_max' => 'decimal:2',
    ];

    public function investigations(): HasMany
    {
        return $this->hasMany(Investigation::class);
    }
}
