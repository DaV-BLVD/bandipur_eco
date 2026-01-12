<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutOne extends Model
{
    use HasFactory;

    protected $fillable = ['since', 'title', 'subtitle', 'description', 'suites', 'acres', 'views', 'image', 'quote'];
}
