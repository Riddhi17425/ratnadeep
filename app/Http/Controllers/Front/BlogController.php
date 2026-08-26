<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')->orderBy('date', 'desc')->paginate(6);

        return view('front.blogs', compact('blogs'));
    }

    public function detail($slug)
    {
        $blog = Blog::where('url', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        $recentBlogs = Blog::where('status', 'published')
                           ->where('id', '!=', $blog->id)
                           ->orderBy('date', 'desc')
                           ->take(3)
                           ->get();

        return view('front.blog-detail', compact('blog', 'recentBlogs'));
    }
}
