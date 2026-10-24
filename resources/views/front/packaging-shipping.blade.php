@extends('front.layouts.main')

@section('title', 'Packaging & Shipping | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/inner-common.css') }}?v={{ filemtime(public_path('frontend/assets/css/inner-common.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/packaging.css') }}?v={{ filemtime(public_path('frontend/assets/css/packaging.css')) }}">
@endsection

@section('content')
@php
    $arrow = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<main class="page-inner page-packaging">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--packaging container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ pt_image('packaging.hero_image') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>{{ pt('packaging.hero_badge') }}</span>
                        </div>
                        <h1 class="hero-title">{{ pt('packaging.hero_title') }}</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">{{ pt('packaging.hero_subtitle') }}</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">{{ pt('packaging.hero_button_1') }} <span class="ms-2">{!! $arrow !!}</span></a>
                            <a href="{{ route('contact') }}" class="com_btn_outline_white">{{ pt('packaging.hero_button_2') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packaging Excellence -->
    <section class="inner-section packaging-intro">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('packaging.intro_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('packaging.intro_title') }}</h2>
            </div>
            <p class="inner-lead inner-lead--center">{{ pt('packaging.intro_text') }}</p>
        </div>
    </section>

    <!-- Packaging Options -->
    @if($options->isNotEmpty())
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('packaging.options_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('packaging.options_title') }}</h2>
            </div>
            <div class="packaging-options">
                @foreach($options as $option)
                    <article class="inner-card">
                        <div class="inner-card-media">
                            @if($option->image)
                                <img src="{{ asset($option->image) }}" alt="{{ $option->alt_image_text ?: $option->title }}" loading="lazy">
                            @endif
                        </div>
                        <h3 class="inner-card-title">{{ $option->title }}</h3>
                        <div class="inner-card-text">{!! $option->description !!}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Our Approach -->
    @if($approach->isNotEmpty())
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap" style="margin-bottom:40px;">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('packaging.approach_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('packaging.approach_title') }}</h2>
            </div>
            <div class="num-grid">
                @foreach($approach as $item)
                    <div class="num-card">
                        <span class="num-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="num-card-title">{{ $item->title }}</h3>
                            <div class="num-card-text">{!! $item->description !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Export Options -->
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-feature inner-feature--sticky">
                <div class="inner-feature-media">
                    <img src="{{ pt_image('packaging.export_image') }}" alt="{{ pt('packaging.export_title') }}">
                </div>
                <div class="inner-feature-copy">
                    <div class="inner-feature-head">
                        <div class="section-badge">
                            <span class="badge-dot purple-dot"></span>
                            {{ pt('packaging.export_badge') }}
                        </div>
                        <h2 class="section-title inner-title">{{ pt('packaging.export_title') }}</h2>
                        <p class="inner-lead inner-lead--sm">{{ pt('packaging.export_text') }}</p>
                    </div>
                    @if($exports->isNotEmpty())
                    <div class="export-cards">
                        @foreach($exports as $export)
                            <div class="export-card">
                                @if($export->image)
                                    <div class="export-card-icon">
                                        <img src="{{ asset($export->image) }}" alt="{{ $export->alt_image_text }}">
                                    </div>
                                @endif
                                <h3 class="export-card-title">{{ $export->title }}</h3>
                                <div class="export-card-text">{!! $export->description !!}</div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Global Logistics -->
    @if($modes->isNotEmpty())
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('packaging.modes_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('packaging.modes_title') }}</h2>
            </div>
            <div class="logistics-row">
                @foreach($modes as $mode)
                    <div class="logistics-item">
                        @if($mode->image)
                            <div class="logistics-item-icon">
                                <img src="{{ asset($mode->image) }}" alt="{{ $mode->alt_image_text }}">
                            </div>
                        @endif
                        <span class="logistics-item-label">{{ $mode->title }}</span>
                    </div>
                    @if(!$loop->last)
                        <div class="logistics-divider"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- FAQs -->
    @include('front.partials.inner-faq', ['faqs' => $faqs, 'page' => 'packaging'])
</main>
@endsection

@push('scripts')
    @include('front.partials.inner-faq-script')
@endpush

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
