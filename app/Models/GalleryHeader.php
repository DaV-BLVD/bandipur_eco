<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryHeader extends Model
{
    protected $fillable = ['badge_text', 'title', 'subtitle', 'is_active'];
}
