<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use App\Enums\SectionType;

class Section extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'image',
        'featured_title',
        'subtitle',
        'label',
        'link',
        'description',
        'bg_color',
        'text_color',
        'is_car',
        'is_form',
        'type',
        'status',
    ];

      /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => Status::class,
        'type' => SectionType::class,
    ];
    
}
