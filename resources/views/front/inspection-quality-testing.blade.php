@extends('front.layouts.main')

@section('title', 'Inspection & Quality Testing | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/inner-common.css') }}?v={{ filemtime(public_path('frontend/assets/css/inner-common.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/inspection.css') }}?v={{ filemtime(public_path('frontend/assets/css/inspection.css')) }}">
@endsection

@section('content')
@php
    $arrow = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<main class="page-inner page-inspection">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--inspection container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ pt_image('inspection.hero_image') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>{{ pt('inspection.hero_badge') }}</span>
                        </div>
                        <h1 class="hero-title">{{ pt('inspection.hero_title') }}</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">{{ pt('inspection.hero_subtitle') }}</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">{{ pt('inspection.hero_button_1') }} <span class="ms-2">{!! $arrow !!}</span></a>
                            <a href="{{ route('products') }}" class="com_btn_outline_white">{{ pt('inspection.hero_button_2') }}</a>
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
                        {{ pt('inspection.intro_badge') }}
                    </div>
                    <h2 class="section-title inner-title inner-title--md text-start">{{ pt('inspection.intro_title') }}</h2>
                </div>
                <div class="inner-split-text">
                    <p>{{ pt('inspection.intro_text_1') }}</p>
                    <p>{{ pt('inspection.intro_text_2') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quality approach -->
    @if($approach->isNotEmpty())
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('inspection.approach_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('inspection.approach_title') }}</h2>
            </div>
            <div class="approach-grid">
                @foreach($approach as $step)
                    <div class="approach-card">
                        <span class="approach-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="approach-card-title">{{ $step->title }}</h3>
                            <div class="approach-card-text">{!! $step->description !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Destructive testing -->
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-feature">
                <div class="inner-feature-copy">
                    <div class="inner-feature-head">
                        <div class="section-badge">
                            <span class="badge-dot purple-dot"></span>
                            {{ pt('inspection.destructive_badge') }}
                        </div>
                        <h2 class="section-title inner-title">{{ pt('inspection.destructive_title') }}</h2>
                        <p class="testing-desc">{{ pt('inspection.destructive_text') }}</p>
                    </div>
                    @if($destructive->isNotEmpty())
                    <div class="testing-lists">
                        @foreach($destructive->pluck('title')->chunk((int) ceil($destructive->count() / 2)) as $column)
                            <ul class="testing-list">
                                @foreach($column as $test)
                                    <li>{{ $test }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="inner-feature-media">
                    <img src="{{ pt_image('inspection.destructive_image') }}" alt="{{ pt('inspection.destructive_title') }}">
                </div>
            </div>
        </div>
    </section>

    <!-- Non-destructive testing -->
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-feature inner-feature--reverse">
                <div class="inner-feature-media">
                    <img src="{{ pt_image('inspection.non_destructive_image') }}" alt="{{ pt('inspection.non_destructive_title') }}">
                </div>
                <div class="inner-feature-copy">
                    <div class="inner-feature-head">
                        <div class="section-badge">
                            <span class="badge-dot purple-dot"></span>
                            {{ pt('inspection.non_destructive_badge') }}
                        </div>
                        <h2 class="section-title inner-title">{{ pt('inspection.non_destructive_title') }}</h2>
                        <p class="testing-desc">{{ pt('inspection.non_destructive_text') }}</p>
                    </div>
                    @if($nonDestructive->isNotEmpty())
                    <div class="testing-lists">
                        @foreach($nonDestructive->pluck('title')->chunk((int) ceil($nonDestructive->count() / 2)) as $column)
                            <ul class="testing-list">
                                @foreach($column as $test)
                                    <li>{{ $test }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Testing capabilities -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('inspection.capabilities_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('inspection.capabilities_title') }}</h2>
            </div>
            <p class="inner-lead inner-lead--center capabilities-text" style="max-width:1536px;">{{ ptb('inspection.capabilities_text') }}</p>
        </div>
    </section>

    <!-- Why Ratnadeep quality -->
    @if($reasons->isNotEmpty())
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('inspection.why_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('inspection.why_title') }}</h2>
            </div>
            <div class="num-grid" style="margin-top:40px;">
                @foreach($reasons as $reason)
                    <div class="num-card">
                        <span class="num-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="num-card-title">{{ $reason->title }}</h3>
                            <div class="num-card-text">{!! $reason->description !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- FAQs -->
    @include('front.partials.inner-faq', ['faqs' => $faqs, 'page' => 'inspection'])
</main>
@endsection

@push('scripts')
    @include('front.partials.inner-faq-script')
@endpush

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
