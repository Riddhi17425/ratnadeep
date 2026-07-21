<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video',
        'alt_video_text',
        'icon',
        'alt_icon_text',
        'short_description',
        'date_from',
        'date_to',
        'reference',
        'status',
    ];

    protected $casts = [
        'date_from' => 'date',
        'date_to'   => 'date',
    ];
}