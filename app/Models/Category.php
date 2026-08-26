<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'shortdescription',
        'metatitle', 'metadescription', 'image', 'alt_image_text', 'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->title) . '-' . uniqid();
        });

        static::updating(function ($category) {
            if ($category->isDirty('title')) {
                $category->slug = Str::slug($category->title) . '-' . uniqid();
            }
        });
    }

    public function banners()
    {
        return $this->hasMany(Banner::class, 'category_id')->where('status', 1);
    }
}