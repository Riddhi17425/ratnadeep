<?php

use App\Models\Category;
use App\Models\Industry;
use App\Models\Certificate;
use App\Models\Setting;
use App\Models\Blog;

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
        $query = Industry::where('status', 1)->latest();

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
        $query = Blog::where('status', 'published')->orderBy('date', 'desc');

        if ($limit !== null) {
            $query->take($limit);
        }
        return $query->get();
    }
}