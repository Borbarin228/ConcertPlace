<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $table = 'ticket';

    protected $fillable = [
        'user_id',
        'number',
        'concert_id',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Ticket_Category::class, 'category_id');
    }
}
