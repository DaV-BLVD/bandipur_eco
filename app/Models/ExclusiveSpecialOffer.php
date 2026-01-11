<?php

// app/Models/ExclusiveSpecialOffer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExclusiveSpecialOffer extends Model
{
    protected $fillable = ['title', 'description', 'discount', 'icon', 'tags', 'status'];

    protected $casts = [
        'tags' => 'array',
        'status' => 'boolean',
    ];
}
