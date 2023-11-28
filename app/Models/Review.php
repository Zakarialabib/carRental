<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'review',
        'rate',
        'author_ip',
        'status'
    ];

    /**
     * Get Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUserInfo()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public static function getDisplayTextScoreByLever($lever)
    {
        switch ($lever) {
            case 5:
                return __("Excellent");
                break;
            case 4:
                return __("Very Good");
                break;
            case 3:
                return __("Average");
                break;
            case 2:
                return __("Poor");
                break;
            case 1:
            case 0:
                return __("Terrible");
                break;
            default:
                return __("Not rated");
                break;
        }
    }

    public static function countReviewByStatus($status = false)
    {
        $count = parent::query();
        if (!empty($status)) {
            $count->where("status", $status);
        }
        return $count->count("id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id")->select(['id','name','first_name','last_name','avatar_id'])->withDefault();
    }
}
