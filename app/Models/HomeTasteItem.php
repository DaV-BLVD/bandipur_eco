<?php

// app/Models/HomeTasteItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTasteItem extends Model
{
    protected $fillable = ['home_taste_id', 'text', 'order'];

    public function homeTaste()
    {
        return $this->belongsTo(HomeTaste::class);
    }
}
