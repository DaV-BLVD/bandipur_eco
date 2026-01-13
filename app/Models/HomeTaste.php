<?php

// app/Models/HomeTaste.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTaste extends Model
{
    protected $fillable = ['subtitle', 'title', 'description'];

    public function items()
    {
        return $this->hasMany(HomeTasteItem::class)->orderBy('order');
    }
}
