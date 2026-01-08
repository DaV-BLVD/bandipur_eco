<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactHeader extends Model
{   
    use HasFactory;
    protected $table = 'contact_headers';
    protected $fillable = [
        'badge_text',
        'title',
        'description',
        'is_active',
    ];
}
