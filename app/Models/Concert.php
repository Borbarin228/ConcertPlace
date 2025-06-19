<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Concert extends Model
{
    protected $fillable = [
        'city',
        'place',
        'start_at',
        'is_accepted',
        'user_id',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketCategories(): BelongsToMany
    {
        return $this->belongsToMany(Ticket_Category::class, 'concert_category', 'concert_id', 'ticket_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}
