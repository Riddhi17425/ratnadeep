<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'section', 'title', 'description', 'phone', 'email', 'image', 'alt_image_text', 'sort_order', 'status',
    ];
}
