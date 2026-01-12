<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutHeader extends Model
{
    protected $fillable = ['badge_text', 'heading', 'description', 'status', 'sort_order'];
}
