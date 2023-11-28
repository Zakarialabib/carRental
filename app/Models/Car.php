<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use App\Traits\Rentable;

class Car extends Model
{
    use Rentable;
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'description',
        'brand',
        'model',
        'seats',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => Status::class,
        'faqs'  => 'array', 
        'extra_price'  => 'array', 
        'service_fee'  => 'array',
        'price'=>'float',
        'sale_price'=>'float',
        'specifications' => 'array',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
}
