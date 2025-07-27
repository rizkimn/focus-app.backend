<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FocusSession extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'duration',
        'date',
        'time',
    ];

    /**
     * Get the user for the focus_sessions.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
