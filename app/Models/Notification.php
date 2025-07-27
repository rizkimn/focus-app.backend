<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'message',
        'is_read',
    ];

    /**
     * Get the user for the notifications.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
