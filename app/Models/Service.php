<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Location;

class Service extends Model
{
    
    use SoftDeletes;

    public $type = 'service';

    protected $fillable = [
        'title',
        'location_id',
        'address',
        'map_lat',
        'map_lng',
        'is_featured',
        'price',
        'sale_price',
        'min_day_before_booking',
        'status'
    ];

    public static function deleteService($model)
    {
        try {
            if (!empty($service)) {
                $a = $service->delete();
            }
        } catch (\Exception $e) {
        }
    }

    public static function restoreService($model)
    {
        try {
            if (!empty($service)) {
                $service->restore();
            }
        } catch (\Exception $e) {
        }
    }
}