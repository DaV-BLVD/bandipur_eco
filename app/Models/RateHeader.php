<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateHeader extends Model
{
    protected $fillable = ['badge_text', 'title', 'highlight_text', 'description', 'room_types', 'off_season_discount', 'service_hours', 'is_active'];
}
