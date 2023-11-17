<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EnquiryReply extends Model
{

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class,'parent_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }
    
}
