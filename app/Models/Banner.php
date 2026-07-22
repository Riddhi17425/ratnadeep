<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'shortnote',
        'description',
        'image',
        'alt_image_text',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}