@extends('front.layouts.main')

@section('title', ($product->meta_title ?: $product->title) . ' | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/inner-common.css') }}?v={{ filemtime(public_path('frontend/assets/css/inner-common.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/products.css') }}?v={{ filemtime(public_path('frontend/assets/css/products.css')) }}">
@if($product->meta_description)
<meta name="description" content="{{ $product->meta_description }}">
@endif
@endsection

@section('content')
@php
    $arrow = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $heroImage = $product->hero_image ?: 'frontend/assets/images/Products/product-detail-hero.jpg';
    $overviewImage = $product->overview_image ?: 'frontend/assets/images/Products/product-detail-overview.jpg';
    $badge = collect([$product->category?->title, $product->type])->filter()->implode(' · ');
    $features = collect($product->features ?? []);
    $specs = collect($product->specs ?? []);
    $grades = collect($product->grades ?? []);
    $overview = collect($product->overview ?? []);
    $heroCopy = $product->hero_text ?: $product->summary;
@endphp
<main class="page-inner page-product-detail">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--product-detail container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ asset($heroImage) }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        @if($badge)
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>{{ $badge }}</span>
                        </div>
                        @endif
                        <h1 class="hero-title">{{ $product->title }}</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <div class="hero-subtitle">{!! $heroCopy !!}</div>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">{{ pt('product_detail.hero_button_1') }} <span class="ms-2">{!! $arrow !!}</span></a>
                            @if($product->datasheet)
                                <a href="{{ asset($product->datasheet) }}" target="_blank" rel="noopener" class="com_btn_outline_white">{{ pt('product_detail.hero_button_2') }}</a>
                            @else
                                <a href="{{ route('contact') }}" class="com_btn_outline_white">{{ pt('product_detail.hero_button_2') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-split">
                <div class="inner-badge-wrap inner-badge-wrap--left">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        {{ pt('product_detail.overview_badge') }}
                    </div>
                    <h2 class="section-title inner-title inner-title--md text-start">{{ $product->overview_title ?: $product->title }}</h2>
                </div>
                <div class="inner-split-text">
                    @forelse($overview as $paragraph)
                        {!! \Illuminate\Support\Str::contains($paragraph, '<') ? $paragraph : '<p>' . e($paragraph) . '</p>' !!}
                    @empty
                        {!! \Illuminate\Support\Str::contains($product->summary ?? '', '<') ? $product->summary : '<p>' . e($product->summary) . '</p>' !!}
                        <p>For dimensions, grades and specifications for this range, please speak to our engineers.</p>
                    @endforelse
                </div>
            </div>

            @if($product->overview_image || $features->isNotEmpty())
                <div class="pd-gallery">
                    <img src="{{ asset($overviewImage) }}" alt="{{ $product->title }}">
                    <div class="pd-gallery-dots" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span></div>
                </div>
            @endif

            @if($features->isNotEmpty())
                <div class="pd-features">
                    @foreach($features as $feature)
                        <div class="pd-feature">
                            <span class="pd-feature-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div>
                                <h3 class="pd-feature-title">{{ $feature['title'] ?? '' }}</h3>
                                <div class="pd-feature-text">{!! $feature['text'] ?? '' !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Specifications -->
    @if($specs->isNotEmpty())
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('product_detail.specs_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('product_detail.specs_title') }}</h2>
            </div>
            <div class="pd-table-wrap">
                <table class="pd-table">
                    <colgroup><col class="pd-col-1"><col class="pd-col-2"><col class="pd-col-3"></colgroup>
                    <thead>
                        <tr><th>{{ pt('product_detail.specs_col_1') }}</th><th>{{ pt('product_detail.specs_col_2') }}</th><th>{{ pt('product_detail.specs_col_3') }}</th></tr>
                    </thead>
                    <tbody>
                        @foreach($specs as $row)
                            <tr><td>{{ $row['parameter'] ?? '' }}</td><td>{{ $row['value'] ?? '' }}</td><td>{{ $row['notes'] ?? '' }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @endif

    <!-- Grades -->
    @if($grades->isNotEmpty())
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('product_detail.grades_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('product_detail.grades_title') }}</h2>
            </div>
            <div class="pd-grades">
                @foreach($grades as $grade)
                    @php
                        $grade = trim($grade);
                        $gradeLen = strlen($grade);
                        $gradeClass = $gradeLen <= 6 ? 'pd-grade--fixed' : ($gradeLen <= 8 ? 'pd-grade--wide' : '');
                    @endphp
                    <span class="pd-grade {{ $gradeClass }}">{{ $grade }}</span>
                    @if($loop->iteration === 6)<span class="pd-grades-break" aria-hidden="true"></span>@endif
                @endforeach
            </div>
            <div class="pd-grades-note">
                <p>{{ pt('product_detail.grades_note') }}</p>
                <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">{{ pt('product_detail.grades_button') }} <span class="ms-2">{!! $arrow !!}</span></a>
            </div>
        </div>
    </section>
    @endif

    <!-- Industries -->
    @if($industries->isNotEmpty())
    <section class="inner-section inner-section--last">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('product_detail.industries_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('product_detail.industries_title') }}</h2>
            </div>
            <div class="pd-industries">
                @foreach($industries as $industry)
                    <div class="pd-industry">
                        @if($industry->image)
                            <img src="{{ asset($industry->image) }}" alt="{{ $industry->alt_image_text ?: $industry->title }}" loading="lazy">
                        @endif
                        <span>{{ $industry->title }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</main>
@endsection

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
