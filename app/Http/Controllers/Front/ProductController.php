<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->orderBy('sort_order')->orderBy('id')->get();

        // Filter tabs = active categories (material families)
        $categories = Category::where('status', 1)->orderBy('id')->get();

        // Default tab: the first family that has products (Figma opens on "Stainless Steel")
        $activeCategoryId = $categories->first(fn ($category) => $products->contains('category_id', $category->id))?->id;

        return view('front.products', compact('products', 'categories', 'activeCategoryId'));
    }

    public function show(string $slug)
    {
        $product = Product::with('category')->where('slug', $slug)->where('status', 1)->firstOrFail();

        return view('front.product-detail', [
            'product'    => $product,
            'industries' => $product->industriesForDetail(),
        ]);
    }
}
