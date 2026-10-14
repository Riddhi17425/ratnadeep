<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View::composer([
        //     'front.layouts.partials.products-mega-menu',
        //     'front.layouts.partials.footer',
        // ], function ($view) {
        //     $view->with('productMegaMenuProducts', Product::where('status', 1)
        //         ->orderBy('created_at', 'desc')
        //         ->get());
        // });
        $productMegaMenuProducts = Product::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        View::composer([
            'front.layouts.partials.products-mega-menu',
            'front.layouts.partials.footer',
        ], function ($view) use ($productMegaMenuProducts) {
            $view->with('productMegaMenuProducts', $productMegaMenuProducts);
        });

    }
}
