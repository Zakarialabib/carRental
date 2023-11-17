<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Availability extends Model
{
    use HasFactory;
    use SoftDeletes;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
        'sale_price',
        'start_date',
        'pickup_time',
        'end_date',
        'dropoff_time',
        'description',
        'location_id',
        'car_id',
        'user_id',
        'status',
    ];

      /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => Status::class,
        'price'=>'float',
        'sale_price'=>'float',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
