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
            $category->slug = static::uniqueSlug($category->slug ?: $category->title);
        });

        static::updating(function ($category) {
            if ($category->isDirty('slug')) {
                $category->slug = static::uniqueSlug($category->slug ?: $category->title, $category->id);
            } elseif ($category->isDirty('title')) {
                $category->slug = static::uniqueSlug($category->title, $category->id);
            }
        });
    }

    public static function uniqueSlug(string $value, $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'category';
        $slug = $base;
        $suffix = 2;

        while (static::withTrashed()->where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $suffix++;
        }

        return $slug;
    }

    public function banners()
    {
        return $this->hasMany(Banner::class, 'category_id')->where('status', 1);
    }
}