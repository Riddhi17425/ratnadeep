@extends('front.layouts.main')

@section('title', $product['title'] . ' | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/inner-common.css') }}?v={{ filemtime(public_path('frontend/assets/css/inner-common.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/products.css') }}?v={{ filemtime(public_path('frontend/assets/css/products.css')) }}">
@endsection

@section('content')
@php
    $arrow = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $detail = $product['detail'] ?? null;
    $industries = $detail['industries'] ?? [
        ['title' => 'Oil & Gas', 'image' => 'pd-oil-gas.jpg'],
        ['title' => 'Petrochemicals & Refineries', 'image' => 'pd-petrochemicals.jpg'],
        ['title' => 'Power Plants', 'image' => 'pd-power-plants.jpg'],
        ['title' => 'Automotive', 'image' => 'pd-automotive.jpg'],
    ];
@endphp
<main class="page-inner page-product-detail">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--product-detail container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ asset('frontend/assets/images/Products/product-detail-hero.jpg') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>{{ $product['family'] }} &middot; {{ $product['type'] }}</span>
                        </div>
                        <h1 class="hero-title">{{ $product['title'] }}</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">{{ $detail['hero_text'] ?? $product['summary'] }}</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">Speak to Our Engineers <span class="ms-2">{!! $arrow !!}</span></a>
                            <a href="{{ route('contact') }}" class="com_btn_outline_white">Download Datasheet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($detail)
        <!-- Overview -->
        <section class="inner-section">
            <div class="container">
                <div class="inner-split">
                    <div class="inner-badge-wrap inner-badge-wrap--left">
                        <div class="section-badge">
                            <span class="badge-dot purple-dot"></span>
                            Product Overview
                        </div>
                        <h2 class="section-title inner-title inner-title--md text-start">{{ $detail['overview_title'] }}</h2>
                    </div>
                    <div class="inner-split-text">
                        @foreach($detail['overview'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="pd-gallery">
                    <img src="{{ asset('frontend/assets/images/Products/product-detail-overview.jpg') }}" alt="{{ $product['title'] }}">
                    <div class="pd-gallery-dots" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span></div>
                </div>
                <div class="pd-features">
                    @foreach($detail['features'] as $feature)
                        <div class="pd-feature">
                            <span class="pd-feature-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div>
                                <h3 class="pd-feature-title">{{ $feature['title'] }}</h3>
                                <p class="pd-feature-text">{{ $feature['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Specifications -->
        <section class="inner-section">
            <div class="container-fluid">
                <div class="inner-badge-wrap">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        Dimensional Specifications
                    </div>
                    <h2 class="section-title inner-title">Size Range, Schedules &amp; Standards</h2>
                </div>
                <div class="pd-table-wrap">
                    <table class="pd-table">
                        <colgroup><col class="pd-col-1"><col class="pd-col-2"><col class="pd-col-3"></colgroup>
                        <thead>
                            <tr><th>Parameter</th><th>Range / Value</th><th>Notes</th></tr>
                        </thead>
                        <tbody>
                            @foreach($detail['specs'] as $row)
                                <tr><td>{{ $row[0] }}</td><td>{{ $row[1] }}</td><td>{{ $row[2] }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Grades -->
        <section class="inner-section">
            <div class="container-fluid">
                <div class="inner-badge-wrap">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        Available Grades
                    </div>
                    <h2 class="section-title inner-title">Grades &amp; Material Specifications</h2>
                </div>
                <div class="pd-grades">
                    @foreach($detail['grades'] as $grade)
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
                    <p>Grade not listed? Ratnadeep can manufacture to customer-specified grades.</p>
                    <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">Share your specification <span class="ms-2">{!! $arrow !!}</span></a>
                </div>
            </div>
        </section>
    @else
        <!-- Overview (summary only until a detailed design is available) -->
        <section class="inner-section">
            <div class="container">
                <div class="inner-split">
                    <div class="inner-badge-wrap inner-badge-wrap--left">
                        <div class="section-badge">
                            <span class="badge-dot purple-dot"></span>
                            Product Overview
                        </div>
                        <h2 class="section-title inner-title inner-title--md text-start">{{ $product['title'] }}</h2>
                    </div>
                    <div class="inner-split-text">
                        <p>{{ $product['summary'] }}</p>
                        <p>For dimensions, grades and specifications for this range, please speak to our engineers.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Industries -->
    <section class="inner-section inner-section--last">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    Powering Critical Industries
                </div>
                <h2 class="section-title inner-title">Protecting Industries That Shape Tomorrow</h2>
            </div>
            <div class="pd-industries">
                @foreach($industries as $industry)
                    <div class="pd-industry">
                        <img src="{{ asset('frontend/assets/images/Products/' . $industry['image']) }}" alt="{{ $industry['title'] }}" loading="lazy">
                        <span>{{ $industry['title'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
