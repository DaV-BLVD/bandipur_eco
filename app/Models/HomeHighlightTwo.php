<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHighlightTwo extends Model
{
    protected $fillable = ['label', 'heading', 'description', 'image_one', 'image_two'];

    public function items()
    {
        return $this->hasMany(HomeHighlightTwoItem::class)->orderBy('order');
    }
}
