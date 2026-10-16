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

    /** Industries picked for the detail page (falls back to the latest active ones). */
    public function industriesForDetail(int $fallbackLimit = 4)
    {
        $ids = array_values(array_filter((array) $this->industry_ids));

        if ($ids) {
            return Industry::where('status', 1)->whereIn('id', $ids)->get()
                ->sortBy(fn ($industry) => array_search($industry->id, $ids))
                ->values();
        }

        return Industry::where('status', 1)->latest()->take($fallbackLimit)->get();
    }

    public function hasDetail(): bool
    {
        return !empty($this->overview) || !empty($this->features) || !empty($this->specs) || !empty($this->grades);
    }
}
