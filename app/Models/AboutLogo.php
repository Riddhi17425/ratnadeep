<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutLogo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'alt_image_text',
        'status',
    ];
}
