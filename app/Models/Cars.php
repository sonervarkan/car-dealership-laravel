<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'gear_type',
        'fuel_type',
        'mileage',
        'year',
        'color',
        'price',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->hasMany(Images::class, 'car_id');
    }

}
