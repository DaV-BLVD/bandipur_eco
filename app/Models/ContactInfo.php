<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'title', 'subtitle', 'value', 'link', 'theme_color', 'is_active'];

    // ADD THIS SECTION
    protected $casts = [
        'value' => 'array',
        'link' => 'array',
        'is_active' => 'boolean',
    ];
}
