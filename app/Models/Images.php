<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $fillable = [
        'img_url',
        'car_id',
    ];

    public function car()
    {
        return $this->belongsTo(Cars::class);
    }
}
