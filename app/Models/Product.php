<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 'title', 'slug', 'type', 'summary', 'image', 'alt_image_text', 'is_wide',
        'hero_text', 'hero_image', 'overview_title', 'overview', 'overview_image', 'datasheet',
        'features', 'specs', 'grades', 'industry_ids',
        'meta_title', 'meta_description', 'sort_order', 'status',
    ];

    protected $casts = [
        'overview'     => 'array',
        'features'     => 'array',
        'specs'        => 'array',
        'grades'       => 'array',
        'industry_ids' => 'array',
        'is_wide'      => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /** Application cards picked for the detail page (falls back to the first active cards). */
    public function applicationsForDetail(int $fallbackLimit = 4)
    {
        $ids = array_values(array_filter((array) $this->industry_ids));

        if ($ids) {
            return PageItem::where('section', 'applications.items')
                ->where('status', 1)
                ->whereIn('id', $ids)
                ->get()
                ->sortBy(fn ($application) => array_search($application->id, $ids))
                ->values();
        }

        return PageItem::where('section', 'applications.items')
            ->where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take($fallbackLimit)
            ->get();
    }

    public function hasDetail(): bool
    {
        return !empty($this->overview) || !empty($this->features) || !empty($this->specs) || !empty($this->grades);
    }
}
