<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Bookable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image_id',
        'map_lat',
        'map_lng',
        'map_zoom',
        'status',
        'parent_id',
        'banner_image_id',
    ];
    
    protected $casts = [
        'status' => Status::class
    ];
    
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

}
