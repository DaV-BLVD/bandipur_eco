<?php

// app/Models/HomeImagesGrid.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeImagesGrid extends Model
{
    protected $fillable = ['image', 'alt_text', 'position'];
}
