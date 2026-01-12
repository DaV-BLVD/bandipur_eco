<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTwo extends Model
{
    use HasFactory;

    protected $fillable = ['tagline', 'title', 'description1', 'description2', 'image', 'feature1_icon', 'feature1_title', 'feature1_description', 'feature2_icon', 'feature2_title', 'feature2_description'];
}
