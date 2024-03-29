<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    

    protected $fillable = [
        'name',
        'email',
        'phone',
        'note',
        'status',
    ];

    public static $enquiryStatus = [
        'pending',
        'completed',
        'cancel',
    ];

    public function fill(array $attributes)
    {
        if (!empty($attributes)) {
            foreach ($this->fillable as $item) {
                $attributes[$item] = $attributes[$item] ?? null;
            }
        }
        return parent::fill($attributes); // TODO: Change the autogenerated stub
    }

  
    public function getStatusNameAttribute()
    {
        return booking_status_to_text($this->status);
    }

    public function replies(){
        return $this->hasMany(EnquiryReply::class,'parent_id');
    }
}
