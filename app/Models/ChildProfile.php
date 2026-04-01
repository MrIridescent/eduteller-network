<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildProfile extends Model
{
    use HasUlids;

    protected $fillable = [
        'parent_id',
        'name',
        'age',
        'traits',
        'interests',
        'learning_goals',
    ];

    protected $casts = [
        'traits' => 'array',
        'interests' => 'array',
        'age' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
