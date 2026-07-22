<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category',
        'title',
        'url',
        'date',
        'short_description',
        'long_description',
        'conclusion',
        'front_image',
        'front_image_alt',
        'detail_image',
        'detail_image_alt',
        'cta_image',
        'cta_image_alt',
        'cta_link_url',
        'schema_json',
        'meta_title',
        'meta_description',
        'faqs',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'faqs' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}