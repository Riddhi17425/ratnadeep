@extends('front.layouts.main')

@section('title', 'Our Products | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/inner-common.css') }}?v={{ filemtime(public_path('frontend/assets/css/inner-common.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/products.css') }}?v={{ filemtime(public_path('frontend/assets/css/products.css')) }}">
@endsection

@section('content')
@php
    $arrow = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $defaultFilter = $activeCategoryId ?: 'all';
@endphp
<main class="page-inner page-products">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--products container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ pt_image('products.hero_image') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>{{ pt('products.hero_badge') }}</span>
                        </div>
                        <h1 class="hero-title">{{ pt('products.hero_title') }}</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">{{ pt('products.hero_subtitle') }}</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">{{ pt('products.hero_button') }} <span class="ms-2">{!! $arrow !!}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Intro -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-split">
                <div class="inner-badge-wrap inner-badge-wrap--left">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        {{ pt('products.intro_badge') }}
                    </div>
                    <h2 class="section-title inner-title inner-title--md text-start">{{ pt('products.intro_title') }}</h2>
                </div>
                <div class="inner-split-text">
                    <p>{{ pt('products.intro_text_1') }}</p>
                    <p>{{ pt('products.intro_text_2') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Listing -->
    <section id="products-listing">
        <div class="container-fluid">
            <div class="inner-filters products-filters" role="tablist" aria-label="Filter products by material">
                <button type="button" class="inner-filter {{ $defaultFilter === 'all' ? 'is-active' : '' }}" data-filter="all">{{ pt('products.all_label') }}</button>
                @foreach($categories as $category)
                    <button type="button" class="inner-filter {{ (string) $defaultFilter === (string) $category->id ? 'is-active' : '' }}" data-filter="{{ $category->id }}">{{ $category->title }}</button>
                @endforeach
            </div>

            <div class="catalog-grid">
                @foreach($products as $product)
                    <article class="inner-card catalog-card" data-family="{{ $product->category_id }}">
                        <a href="{{ route('product.detail', $product->slug) }}" class="catalog-card-link">
                            <div class="inner-card-media">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->alt_image_text ?: $product->title }}" loading="lazy">
                                @endif
                            </div>
                            <div class="catalog-card-head">
                                <h2 class="inner-card-title">{{ $product->title }}</h2>
                                <span class="catalog-card-arrow" aria-hidden="true">{!! $arrow !!}</span>
                            </div>
                            <p class="inner-card-text">{{ strip_tags($product->summary ?? '') }}</p>
                        </a>
                    </article>
                @endforeach
            </div>
            <p class="products-empty" id="productsEmpty">{{ pt('products.empty_text') }}</p>
        </div>
    </section>

    <!-- CTA -->
    <section class="inner-section inner-section--last">
        <div class="container-fluid">
            <div class="page-cta page-cta--dark">
                <img src="{{ asset('frontend/assets/images/Common/cta-bg.png') }}" alt="" class="page-cta-image" aria-hidden="true">
                <div class="page-cta-inner">
                    <div class="page-cta-copy">
                        <h2 class="page-cta-title">{{ pt('products.cta_title') }}</h2>
                        <p class="page-cta-text">{{ pt('products.cta_text') }}</p>
                    </div>
                    <div class="page-cta-actions">
                        <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">{{ pt('products.cta_button_1') }}</a>
                        <a href="{{ route('contact') }}" class="com_btn_outline_white">{{ pt('products.cta_button_2') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var filters = document.querySelectorAll('.inner-filter');
    var cards = document.querySelectorAll('.catalog-card');
    var empty = document.getElementById('productsEmpty');

    function apply(family) {
        var shown = 0;
        cards.forEach(function (card) {
            var visible = family === 'all' || card.getAttribute('data-family') === family;
            card.hidden = !visible;
            if (visible) { shown++; }
        });
        empty.classList.toggle('is-visible', shown === 0);
    }

    filters.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filters.forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            apply(btn.getAttribute('data-filter'));
        });
    });

    var active = document.querySelector('.inner-filter.is-active');
    if (active) { apply(active.getAttribute('data-filter')); }
});
</script>
@endpush

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
