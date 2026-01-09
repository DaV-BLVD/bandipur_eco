<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReserveSubmission extends Model
{
    protected $fillable = ['check_in', 'check_out', 'guests', 'room_type', 'full_name', 'phone', 'is_read'];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'is_read' => 'boolean',
    ];
}
