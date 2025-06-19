<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket_Category extends Model
{
    protected $table = 'ticket_categories';
    protected $fillable = [
        'name',
        'description',
        'owner_id',
        'price'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'category_id');
    }

    public function concerts(): BelongsToMany
    {
        return $this->belongsToMany(Concert::class, 'concert_category', 'ticket_category_id', 'concert_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
