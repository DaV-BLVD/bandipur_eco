<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomRate extends Model
{
    protected $fillable = ['badge', 'title', 'tag', 'image', 'price', 'currency', 'rating', 'reviews', 'features', 'sort_order', 'is_active'];

    protected $casts = [
        'features' => 'array',
    ];
}
