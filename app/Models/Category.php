<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'shortdescription',
        'metatitle', 'metadescription', 'image', 'alt_image_text', 'status',
    ];

    public function banners()
    {
        return $this->hasMany(Banner::class, 'category_id')->where('status', 1);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}