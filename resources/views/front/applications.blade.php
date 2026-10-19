@extends('front.layouts.main')

@section('title', 'Applications | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/inner-common.css') }}?v={{ filemtime(public_path('frontend/assets/css/inner-common.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/applications.css') }}?v={{ filemtime(public_path('frontend/assets/css/applications.css')) }}">
@endsection

@section('content')
@php
    $arrow = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<main class="page-inner page-applications">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--applications container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ pt_image('applications.hero_image') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            {{ pt('applications.hero_badge') }}
                        </div>
                        <h1 class="hero-title">{{ pt('applications.hero_title') }}</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">{{ pt('applications.hero_subtitle') }}</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">{{ pt('applications.hero_button') }} <span class="ms-2">{!! $arrow !!}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </section>

    <!-- Intro -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('applications.intro_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('applications.intro_title') }}</h2>
            </div>
            <p class="inner-lead inner-lead--center">{{ pt('applications.intro_text') }}</p>
        </div>
    </section>

    <!-- Applications grid -->
    @if($applications->isNotEmpty())
    <section class="inner-section" id="applications-list">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('applications.list_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('applications.list_title') }}</h2>
            </div>
            <div class="apps-grid">
                @foreach($applications as $application)
                    <article class="inner-card">
                        <div class="inner-card-media">
                            <img src="{{ $application->image ? asset($application->image) : asset('frontend/assets/images/Oil & Gas.webp') }}" alt="{{ $application->alt_image_text ?: $application->title }}" loading="lazy">
                        </div>
                        <h3 class="inner-card-title">{{ Str::title($application->title) }}</h3>
                        <p class="inner-card-text">{{ $application->description ? strip_tags($application->description) : 'Reliable piping solutions engineered to meet the demands of this application.' }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Why Ratnadeep -->
    @if($reasons->isNotEmpty())
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('applications.why_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('applications.why_title') }}</h2>
            </div>
            <div class="num-grid" style="margin-top:40px;">
                @foreach($reasons as $reason)
                    <div class="num-card">
                        <span class="num-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="num-card-title">{{ $reason->title }}</h3>
                            <p class="num-card-text">{!! nl2br(e($reason->description)) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Application matching -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('applications.matching_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('applications.matching_title') }}</h2>
            </div>
            <p class="inner-lead inner-lead--center" style="max-width:1470px;">{{ ptl('applications.matching_text') }}</p>
        </div>
    </section>

    <!-- FAQs -->
    @include('front.partials.inner-faq', ['faqs' => $faqs, 'page' => 'applications'])
</main>
@endsection

@push('scripts')
    @include('front.partials.inner-faq-script')
@endpush

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
