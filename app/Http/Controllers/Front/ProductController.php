<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Support\ProductCatalog;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductCatalog::all();
        $families = ProductCatalog::families();

        return view('front.products', compact('products', 'families'));
    }

    public function show(string $slug)
    {
        $product = ProductCatalog::find($slug);

        abort_if(is_null($product), 404);

        return view('front.product-detail', compact('product'));
    }
}
