@extends('front.layouts.main')

@section('title', 'Blogs | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blogs.css') }}">
@endsection

@section('content')
<main class="page-blogs">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--blogs container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <img src="{{ asset('frontend/assets/images/Contact/contact-hero.png') }}" alt="" class="inner-hero-image">
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="hero-badge">
                        <span class="badge-dot"></span>
                        <span>INDUSTRY INSIGHTS</span>
                    </div>
                    <h1 class="hero-title">Engineering Knowledge.<br>Manufacturing Expertise.</h1>
                    <p class="hero-subtitle">Explore technical articles on pipe and tube manufacturing, material standards, quality systems, and industry best practices from Ratnadeep Metal And Tubes Limited.</p>
                    <div class="hero-buttons">
                        <a href="#blog-listing" class="com_btn_red">Explore Articles <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                        <a href="{{ route('home') }}#products" class="com_btn_outline_white">Explore Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Listing -->
    <section class="mt_80 blog-listing-section" id="blog-listing">
        <div class="container">
            <div class="blog-listing-grid">
                @forelse($blogs as $blog)
                    <article class="blog-listing-card">
                        <a href="{{ route('blog.detail', $blog->url) }}" class="blog-listing-card-link">
                            <div class="blog-listing-image">
                                <img src="{{ $blog->front_image ? asset($blog->front_image) : asset('frontend/assets/images/Homepage/From Our Desk/Blog-1.webp') }}" alt="{{ $blog->front_image_alt ?: $blog->title }}" class="img-fluid w-100">
                            </div>
                            <div class="blog-listing-meta">
                                <time class="blog-listing-date" datetime="{{ $blog->date ? \Carbon\Carbon::parse($blog->date)->format('Y-m-d') : '' }}">
                                    {{ $blog->date ? \Carbon\Carbon::parse($blog->date)->format('F d, Y') : '' }}
                                </time>
                                <span class="blog-listing-arrow" aria-hidden="true">
                                    <span class="arrow-icon"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                </span>
                            </div>
                            <h2 class="blog-listing-title">{{ Str::title($blog->title) }}</h2>
                            <p class="blog-listing-desc">{{ ucfirst(Str::words(strip_tags($blog->short_description), 25, '...')) }}</p>
                        </a>
                    </article>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No blogs found at the moment.</p>
                    </div>
                @endforelse
            </div>

            @if($blogs->hasPages())
                <div class="blog-pagination">
                    {{ $blogs->links('front.layouts.partials.pagination') }}
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
