<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->whereNull('deleted_at')->latest()->get();
        $banners = Banner::with('category')->where('status', 1)->whereNull('deleted_at')->latest()->get();
        $industries = getActiveIndustries(4);
        $blogs = getActiveBlogs(3);

        return view('front.index', compact('categories', 'banners', 'industries', 'blogs'));
    }
}
