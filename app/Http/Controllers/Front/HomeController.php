<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = getActiveCategories(5);
        $industries = getActiveIndustries(4);
        $blogs = getActiveBlogs(3);

        return view('front.index', compact('categories', 'industries', 'blogs'));
    }
}
