<?php

// app/Models/AccommodationHeader.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationHeader extends Model
{
    use HasFactory;

    protected $fillable = ['badge_text', 'title', 'description', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];
}
