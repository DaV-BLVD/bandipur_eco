<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatesTable extends Model
{
    // Explicitly define table because 'rates_tables' is non-standard pluralization
    protected $table = 'rates_tables';

    protected $fillable = ['room_type', 'single_price', 'double_price', 'extra_bed', 'inclusions', 'currency', 'sort_order'];

    protected $casts = [
        'inclusions' => 'array',
        'single_price' => 'float',
        'double_price' => 'float',
        'extra_bed' => 'float',
        'sort_order' => 'integer',
    ];
}
