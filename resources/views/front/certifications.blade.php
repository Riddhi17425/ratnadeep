@extends('front.layouts.main')

@section('title', 'Certifications | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/certifications.css') }}">
@endsection

@section('content')
<main class="page-certifications">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--certifications container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ asset('frontend/assets/images/Certifications/certifications-hero.png') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>CERTIFICATIONS &amp; APPROVALS</span>
                        </div>
                        <h1 class="hero-title">Global Certifications. Proven Manufacturing Standards.</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">Every pipe and tube manufactured by Ratnadeep Metal And Tubes Limited is supported by internationally recognised certifications, quality management systems, and manufacturing standards that reinforce compliance, reliability, and customer confidence.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">Get a Technical Quote <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                            <a href="{{ route('home') }}#products" class="com_btn_outline_white">Browse Our Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications Grid -->
    <section class="cert-listing-section" id="certifications-listing">
        <div class="container-fluid">
            <div class="cert-listing-grid">
                @forelse($certificates as $certificate)
                    <article class="cert-listing-card">
                        <a href="{{ $certificate->image ? asset($certificate->image) : asset('frontend/assets/images/Certifications/cert-ad2000.png') }}" data-fancybox="certificates" data-caption="{{ $certificate->title }}" class="cert-listing-frame d-block">
                            <img src="{{ $certificate->image ? asset($certificate->image) : asset('frontend/assets/images/Certifications/cert-ad2000.png') }}" alt="{{ $certificate->alt_image_text ?: $certificate->title }}" class="cert-listing-image">
                        </a>
                        <div class="cert-listing-body">
                            <h2 class="cert-listing-title">{{ $certificate->title }}</h2>
                        </div>
                    </article>
                @empty
                    <div class="w-100 text-center py-5">
                        <p class="text-muted">No certifications available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</main>
@endsection
