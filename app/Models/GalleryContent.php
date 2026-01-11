<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryContent extends Model
{
    protected $fillable = ['image', 'title', 'category', 'is_active', 'sort_order'];
}
