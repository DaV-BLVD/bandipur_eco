<?php

// app/Models/RateTable.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatesTable extends Model
{
    protected $fillable = ['room_type', 'single_price', 'double_price', 'extra_bed', 'inclusions', 'currency', 'sort_order'];

    protected $casts = [
        'inclusions' => 'array',
    ];
}
