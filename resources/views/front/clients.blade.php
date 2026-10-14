@extends('front.layouts.main')

@section('title', 'Our Clients | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/clients.css') }}">
@endsection

@section('content')
<main class="page-clients">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--clients container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ pt_image('clients.hero_image') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>{{ pt('clients.hero_badge') }}</span>
                        </div>
                        <h1 class="hero-title">{{ pt('clients.hero_title') }}</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">{{ pt('clients.hero_subtitle') }}</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">{{ pt('clients.hero_button_1') }} <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                            <a href="{{ route('home') }}#products" class="com_btn_outline_white">{{ pt('clients.hero_button_2') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted Partnerships -->
    <section class="clients-intro-section">
        <div class="container">
            <div class="clients-intro-grid">
                <div class="clients-intro-left">
                    <div class="section-badge align-left">
                        <span class="badge-dot purple-dot"></span>
                        {{ pt('clients.intro_badge') }}
                    </div>
                    <h2 class="clients-intro-title">{{ pt('clients.intro_title') }}</h2>
                </div>
                <div class="clients-intro-right">
                    <p>{{ pt('clients.intro_text_1') }}</p>
                    <p>{{ pt('clients.intro_text_2') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Logos -->
    <section class="clients-logos-section">
        <div class="container-fluid">
            <div class="clients-logos-header text-center">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('clients.logos_badge') }}
                </div>
                <h2 class="clients-logos-title">{{ pt('clients.logos_title') }}</h2>
            </div>

            <div class="clients-logo-grid">
                @foreach($logoColumns as $logoColumn)
                    <div class="clients-logo-column {{ $loop->odd ? 'clients-logo-column--offset' : '' }} {{ $loop->last && $logoColumn->count() === 1 ? 'clients-logo-column--last' : '' }}">
                        @foreach($logoColumn as $logo)
                            <div class="clients-logo-card">
                                <img src="{{ asset($logo->image) }}" alt="{{ $logo->alt_image_text ?? $logo->title }}">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
