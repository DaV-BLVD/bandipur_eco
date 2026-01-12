<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccommodationHighlight extends Model
{
    protected $fillable = ['title', 'icon', 'status', 'sort_order'];
}
