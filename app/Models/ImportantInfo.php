<?php

// app/Models/ImportantInfo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportantInfo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon', 'items', 'status'];

    protected $casts = [
        'items' => 'array',
        'status' => 'boolean',
    ];
}
