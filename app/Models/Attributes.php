<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attributes extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'value',
        'car_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}