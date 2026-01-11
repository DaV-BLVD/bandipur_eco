<?php
// app/Models/AccommodationHero.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationHero extends Model
{
    use HasFactory;

    protected $table = 'accommodation_heros';
    protected $fillable = ['image', 'alt_text', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];
}
