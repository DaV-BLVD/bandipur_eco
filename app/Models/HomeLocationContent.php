<?php

// app/Models/HomeLocationContent.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeLocationContent extends Model
{
    protected $fillable = ['heading', 'description', 'car_label', 'car_text', 'pickup_label', 'pickup_text'];
}
