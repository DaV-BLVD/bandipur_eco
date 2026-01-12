<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'currency', 'price', 'badge_text', 'image', 'description', 'occupancy', 'bed_type', 'has_wifi'];

    public function getFormattedPriceAttribute()
    {
        if ($this->currency === 'NPR') {
            return 'Rs. ' . number_format($this->price);
        }
        return '$' . number_format($this->price, 2);
    }
}
