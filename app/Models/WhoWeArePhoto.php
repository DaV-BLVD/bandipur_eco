<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhoWeArePhoto extends Model
{
    protected $fillable = ['image_primary', 'title', 'subtitle', 'image_secondary', 'status', 'sort_order'];
}
