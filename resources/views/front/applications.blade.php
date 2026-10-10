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
                    <img src="{{ asset('frontend/assets/images/Applications/applications-hero.jpg') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>ADVANCED INDUSTRIAL APPLICATIONS</span>
                        </div>
                        <h1 class="hero-title">Precision Tubes &amp; Pipes For The World's Most Demanding Applications</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">Ratnadeep manufactures high-performance tubes and pipes engineered for applications where pressure, temperature, corrosion resistance, dimensional accuracy, and long-term reliability are non-negotiable. Our products support mission-centric operations across global process industries.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">Discuss Your Application <span class="ms-2">{!! $arrow !!}</span></a>
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
                    ENGINEERED FOR PERFORMANCE
                </div>
                <h2 class="section-title inner-title">Built For Versatile Operating Environments</h2>
            </div>
            <p class="inner-lead inner-lead--center">Every industrial application presents unique operating conditions. Some demand corrosion resistance; others require exceptional heat transfer, pressure handling, or dimensional precision. Ratnadeep manufactures application-specific tubing solutions that consistently perform across diverse industrial environments while meeting international standards and customer specifications.</p>
        </div>
    </section>

    <!-- Applications grid -->
    <section class="inner-section" id="applications-list">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    APPLICATIONS ACROSS INDUSTRIES
                </div>
                <h2 class="section-title inner-title">Supporting Dynamic Infrastructure Worldwide</h2>
            </div>
            <div class="apps-grid">
                @foreach($applications as $app)
                    <article class="inner-card">
                        <div class="inner-card-media">
                            <img src="{{ asset('frontend/assets/images/Applications/' . $app['image']) }}" alt="{{ $app['title'] }}" loading="lazy">
                        </div>
                        <h3 class="inner-card-title">{{ $app['title'] }}</h3>
                        <p class="inner-card-text">{{ $app['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Ratnadeep -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    WHY RATNADEEP
                </div>
                <h2 class="section-title inner-title">Manufacturing That Matches Your Application</h2>
            </div>
            <div class="num-grid" style="margin-top:40px;">
                @foreach($reasons as $reason)
                    <div class="num-card">
                        <span class="num-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="num-card-title">{{ $reason['title'] }}</h3>
                            <p class="num-card-text">{!! nl2br(e($reason['text'])) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Application matching -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    APPLICATION MATCHING
                </div>
                <h2 class="section-title inner-title">Not Every Application Needs The Same Material</h2>
            </div>
            <p class="inner-lead inner-lead--center" style="max-width:1470px;">Selecting the right tube or pipe is critical to ensuring safe, reliable, and long-lasting performance. Every industrial application has different operating conditions, including pressure, temperature, corrosion exposure, process media, and specific design requirements. Choosing the appropriate material and dimensions helps improve efficiency, durability, and overall system performance.<br>Ratnadeep works closely with customers to understand their technical and application-specific requirements and recommend the most suitable material grade, dimensions, and manufacturing specifications. Our product range includes stainless steel, nickel alloy, carbon steel, low alloy steel, and low fin tubes, allowing us to meet the diverse requirements of demanding industrial environments.</p>
        </div>
    </section>

    <!-- FAQs -->
    <section class="inner-section inner-section--last">
        <div class="container">
            <div class="faq-grid">
                <div class="inner-badge-wrap inner-badge-wrap--left">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        SHIPPING &amp; LOGISTICS FAQs
                    </div>
                    <h2 class="section-title inner-title">Frequently Asked Questions</h2>
                    <p class="inner-lead inner-lead--sm">Find answers to common questions about our export packaging, shipping methods, documentation, and logistics support for domestic and international deliveries.</p>
                </div>
                <div class="faq-list">
                    @foreach($faqs as $faq)
                        <div class="faq-item {{ $loop->first ? 'is-open' : '' }}">
                            <button type="button" class="faq-question" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                <span>{{ $faq['q'] }}</span>
                                <span class="faq-icon"><svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </button>
                            <div class="faq-answer">{{ $faq['a'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.faq-question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = btn.closest('.faq-item');
            var open = item.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    });
});
</script>
@endpush

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
