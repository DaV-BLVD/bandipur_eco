<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeHeroSlider extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'badge_text', 'title_prefix', 'title_highlight', 'title_suffix', 'description', 'button_text', 'button_link', 'color_hex', 'sort_order', 'is_active'];
}
