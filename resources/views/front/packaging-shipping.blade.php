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
                    <img src="{{ asset('frontend/assets/images/Packaging/packaging-hero.jpg') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>PACKAGING &amp; SHIPPING</span>
                        </div>
                        <h1 class="hero-title">Engineered for Protection. Prepared for Delivery.</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">Our industrial pipe packaging and export-ready shipping processes are designed to protect every pipe and tube from dispatch to destination, ensuring product integrity throughout global transportation.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">Request a Technical Quote <span class="ms-2">{!! $arrow !!}</span></a>
                            <a href="{{ route('contact') }}" class="com_btn_outline_white">Download Brochure</a>
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
                    PACKAGING EXCELLENCE
                </div>
                <h2 class="section-title inner-title">Built For Transit. Delivered With Integrity</h2>
            </div>
            <p class="inner-lead inner-lead--center">Every pipe and tube manufactured by Ratnadeep Metal And Tubes Limited is packed using secure industrial packaging, protective materials, and export-ready methods to preserve surface finish, dimensional accuracy, and material integrity throughout storage and transportation. Before dispatch, every shipment undergoes final verification, secure packaging, and documentation to ensure complete material traceability, customer compliance, and dependable global shipping. Every order leaves our facility ready for safe handling, efficient logistics, and reliable delivery.</p>
        </div>
    </section>

    <!-- Packaging Options -->
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    PACKAGING OPTIONS
                </div>
                <h2 class="section-title inner-title">Packaging Designed for Every Destination</h2>
            </div>
            <div class="packaging-options">
                @foreach($options as $option)
                    <article class="inner-card">
                        <div class="inner-card-media"></div>
                        <h3 class="inner-card-title">{{ $option['title'] }}</h3>
                        <p class="inner-card-text">{{ $option['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Our Approach -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap" style="margin-bottom:40px;">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    OUR APPROACH
                </div>
                <h2 class="section-title inner-title">Protection Designed Into Every Shipment</h2>
            </div>
            <div class="num-grid">
                @foreach($approach as $item)
                    <div class="num-card">
                        <span class="num-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="num-card-title">{{ $item['title'] }}</h3>
                            <p class="num-card-text">{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Export Options -->
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-feature">
                <div class="inner-feature-media">
                    <img src="{{ asset('frontend/assets/images/Packaging/export-options.jpg') }}" alt="Export packaging at the Ratnadeep facility">
                </div>
                <div class="inner-feature-copy">
                    <div class="inner-feature-head">
                        <div class="section-badge">
                            <span class="badge-dot purple-dot"></span>
                            PRECISION GLOBAL REACH
                        </div>
                        <h2 class="section-title inner-title">Export Options for Every Shipment</h2>
                        <p class="inner-lead inner-lead--sm">Choose the shipping method best suited to your project requirements. Ratnadeep Metal And Tubes Limited supports flexible export logistics, ensuring pipes and tubes are shipped safely, efficiently, and in accordance with destination requirements.</p>
                    </div>
                    <div class="export-cards">
                        @foreach($exports as $export)
                            <div class="export-card">
                                <div class="export-card-icon">
                                    <img src="{{ asset('frontend/assets/images/Packaging/' . $export['icon']) }}" alt="">
                                </div>
                                <h3 class="export-card-title">{{ $export['title'] }}</h3>
                                <p class="export-card-text">{{ $export['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Global Logistics -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    GLOBAL LOGISTICS
                </div>
                <h2 class="section-title inner-title">Delivered Wherever Industry Demands</h2>
            </div>
            <div class="logistics-row">
                @foreach($modes as $mode)
                    <div class="logistics-item">
                        <div class="logistics-item-icon">
                            <img src="{{ asset('frontend/assets/images/Packaging/' . $mode['icon']) }}" alt="">
                        </div>
                        <span class="logistics-item-label">{{ $mode['label'] }}</span>
                    </div>
                    @if(!$loop->last)
                        <div class="logistics-divider"></div>
                    @endif
                @endforeach
            </div>
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
