<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Concert extends Model
{
    protected $fillable = [
        'city',
        'place',
        'category_id',
        'start_at',
        'is_accepted'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketCategories(): BelongsToMany
    {
        return $this->belongsToMany(Ticket_Category::class, 'concert_category');
    }
}
