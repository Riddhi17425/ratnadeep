<?php

use App\Models\Category;
use App\Models\Industry;
use App\Models\Certificate;
use App\Models\Setting;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\PageItem;
use App\Models\PageText;

if (!function_exists('getActiveCategories')) {
    function getActiveCategories($limit = null)
    {
        $query = Category::with(['banners' => function ($q) {
            $q->where('status', 1);
        }])->where('status', 1)->latest();

        if ($limit !== null) {
            $query->take($limit);
        }
        return $query->get();
    }
}

if (!function_exists('getActiveIndustries')) {
    function getActiveIndustries($limit = null)
    {
        $query = Industry::where('status', 1)->whereNull('deleted_at')->latest();
        if ($limit !== null) {
            $query->take($limit);
        }
        return $query->get();
    }
}

if (!function_exists('getActiveCertificates')) {
    function getActiveCertificates($limit = null)
    {
        $query = Certificate::where('status', 1)->latest();

        if ($limit !== null) {
            $query->take($limit);
        }
        return $query->get();
    }
}

if (!function_exists('getSetting')) {
    function getSetting()
    {
        return Setting::first();
    }
}

if (!function_exists('getActiveBlogs')) {
    function getActiveBlogs($limit = null)
    {
        $query = Blog::where('status', 'published')->whereNull('deleted_at')->orderBy('date', 'desc');

        if ($limit !== null) {
            $query->take($limit);
        }
        return $query->get();
    }
}

/*
 * ---- Inner pages (careers, packaging, inspection, applications, products) ----
 */

if (!function_exists('pageTextRows')) {
    /** All edited texts of one page, cached on the current request object. */
    function pageTextRows(string $page): array
    {
        $attributes = request()->attributes;
        $cacheKey = 'page_texts.' . $page;

        if (!$attributes->has($cacheKey)) {
            try {
                $rows = PageText::where('page', $page)->pluck('value', 'key')->all();
            } catch (\Throwable $e) {
                $rows = [];
            }
            $attributes->set($cacheKey, $rows);
        }

        return $attributes->get($cacheKey);
    }
}

if (!function_exists('pt')) {
    /** Page text: pt('careers.hero_title'). Falls back to the Figma default from config/page_texts.php. */
    function pt(string $path, $default = null): string
    {
        [$page, $key] = array_pad(explode('.', $path, 2), 2, null);
        $rows = pageTextRows($page);
        $value = $rows[$key] ?? null;

        if ($value === null || trim((string) $value) === '') {
            $value = config("page_texts.{$page}.fields.{$key}.2", $default ?? '');
        }

        return (string) $value;
    }
}

if (!function_exists('ptl')) {
    /** Multi-line page text, escaped, new lines as <br>. */
    function ptl(string $path)
    {
        return new \Illuminate\Support\HtmlString(nl2br(e(pt($path))));
    }
}

if (!function_exists('ptb')) {
    /** Page text where **word** becomes <strong>word</strong>. */
    function ptb(string $path)
    {
        $text = e(pt($path));

        return new \Illuminate\Support\HtmlString(preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text));
    }
}

if (!function_exists('ptu')) {
    /** Page text where a trailing "(unit)" goes on its own line: "Annual Revenue (Million $)". */
    function ptu(string $path)
    {
        $text = e(pt($path));

        return new \Illuminate\Support\HtmlString(preg_replace('/\s*(\([^()]*\))\s*$/', '<br>$1', $text));
    }
}

if (!function_exists('pt_image')) {
    /** Image url for a page text of type image (uploaded path or the Figma default asset). */
    function pt_image(string $path): string
    {
        return asset(pt($path));
    }
}

if (!function_exists('getPageItems')) {
    /** Active page items of a section, in admin order. */
    function getPageItems(string $section)
    {
        return PageItem::where('section', $section)->where('status', 1)->orderBy('sort_order')->orderBy('id')->get();
    }
}

if (!function_exists('getFaqs')) {
    function getFaqs(string $page)
    {
        return Faq::where('page', $page)->where('status', 1)->orderBy('sort_order')->orderBy('id')->get();
    }
}
