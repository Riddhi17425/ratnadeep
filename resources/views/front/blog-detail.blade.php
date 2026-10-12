@extends('front.layouts.main')

@section('title', ($blog->meta_title ?: $blog->title) . ' | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blog-detail.css') }}">
@endsection

@section('content')
<main class="page-blog-detail">
    <article class="blog-detail-article">
        <div class="container">
            <header class="blog-detail-header text-center">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ $blog->date ? \Carbon\Carbon::parse($blog->date)->format('F d, Y') : '' }}
                </div>
                <h1 class="blog-detail-title">{{ Str::title($blog->title) }}</h1>
            </header>

            <figure class="blog-detail-featured">
                <img src="{{ $blog->detail_image ? asset($blog->detail_image) : ($blog->front_image ? asset($blog->front_image) : asset('frontend/assets/images/Homepage/From Our Desk/Blog-1.webp')) }}" alt="{{ $blog->detail_image_alt ?: $blog->title }}" class="img-fluid w-100">
            </figure>

            <div class="blog-detail-content">

                {{-- Short Description --}}
                @if(!empty($blog->short_description))
                    <section class="blog-detail-overview">
                        <h2>Overview</h2>
                        {!! $blog->short_description !!}
                    </section>
                @endif

                {{-- Long Description --}}
                @if(!empty($blog->long_description))
                    <section class="blog-detail-description">
                        <h2>Detailed Insights</h2>
                        {!! $blog->long_description !!}
                    </section>
                @endif

            </div>

            @if(!empty($blog->cta_image) || !empty($blog->cta_link_url))
                <aside class="blog-detail-cta" aria-label="Article call to action">
                    <div class="blog-detail-cta-bg">
                        <div class="blog-detail-cta-media" aria-hidden="true">
                            <img src="{{ $blog->cta_image ? asset($blog->cta_image) : asset('frontend/assets/images/Blog/blog-detail-cta.png') }}" alt="{{ $blog->cta_image_alt ?: 'Call to action' }}" class="blog-detail-cta-image">
                            <div class="blog-detail-cta-overlay"></div>
                        </div>
                        <div class="blog-detail-cta-inner">
                            <h2 class="blog-detail-cta-title">Need Technical Consultation on Tube Selection for Your Project?</h2>
                            <p class="blog-detail-cta-text">Our engineering and metallurgy specialists can assist you in selecting the ideal material grade, specification, and dimensional tolerances.</p>
                            <a href="{{ $blog->cta_link_url ?: route('contact') . '#write-to-us' }}" class="com_btn_red">Check Now <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                        </div>
                    </div>
                </aside>
            @endif

            @if(!empty($blog->conclusion))
                <div class="blog-detail-content">
                    <h2>Conclusion</h2>
                    {!! $blog->conclusion !!}
                </div>
            @endif
        </div>
    </article>

    <!-- Recent Posts -->
    @if(isset($recentBlogs) && $recentBlogs->isNotEmpty())
        <section class="blog-detail-related">
            <div class="container">
                <div class="text-center section-header-gap">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        Recent Posts
                    </div>
                    <h2 class="section-title">Experience That Shapes Innovation</h2>
                </div>

                <div class="blog-listing-grid">
                    @foreach($recentBlogs as $recentBlog)
                        <article class="blog-listing-card">
                            <a href="{{ route('blog.detail', $recentBlog->url) }}" class="blog-listing-card-link">
                                <div class="blog-listing-image">
                                    <img src="{{ $recentBlog->front_image ? asset($recentBlog->front_image) : asset('frontend/assets/images/Homepage/From Our Desk/Blog-1.webp') }}" alt="{{ $recentBlog->front_image_alt ?: $recentBlog->title }}" class="img-fluid w-100">
                                </div>
                                <div class="blog-listing-meta">
                                    <time class="blog-listing-date" datetime="{{ $recentBlog->date ? \Carbon\Carbon::parse($recentBlog->date)->format('Y-m-d') : '' }}">
                                        {{ $recentBlog->date ? \Carbon\Carbon::parse($recentBlog->date)->format('F d, Y') : '' }}
                                    </time>
                                    <span class="blog-listing-arrow" aria-hidden="true">
                                        <span class="arrow-icon"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                    </span>
                                </div>
                                <h3 class="blog-listing-title">{{ Str::title($recentBlog->title) }}</h3>
                                <p class="blog-listing-desc">{{ ucfirst(Str::words(strip_tags($recentBlog->short_description), 25, '...')) }}</p>
                            </a>
                        </article>
                    @endforeach
                </div>

                <div class="text-center action-btn-wrapper">
                    <a href="{{ route('blogs') }}" class="com_btn_outline_red">View All Blogs <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>
        </section>
    @endif
    @if(!empty($blog->schema_json))
        <script type="application/ld+json">
            {!! $blog->schema_json !!}
        </script>
    @endif
</main>
@endsection
