<?php

// app/Models/HomeFeature.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFeature extends Model
{
    protected $fillable = ['time', 'title', 'description', 'order'];
}
