<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccommodationHighlightPic extends Model
{
    protected $fillable = ['image', 'rating_text', 'status', 'sort_order'];
}
