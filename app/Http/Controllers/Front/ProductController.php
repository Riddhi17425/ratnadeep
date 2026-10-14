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

        // Show only active categories that have at least one active product.
        $productCategoryIds = $products->pluck('category_id')->filter()->unique();
        $categories = Category::where('status', 1)
            ->whereIn('id', $productCategoryIds)
            ->orderBy('id')
            ->get();

        $activeCategoryId = $categories->first()?->id;

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
