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
                    <img src="{{ asset('frontend/assets/images/Inspection/inspection-hero.jpg') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>QUALITY ASSURANCE</span>
                        </div>
                        <h1 class="hero-title">Inspection &amp; Quality Testing You Can Depend On</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">Every Ratnadeep tube and pipe is manufactured under a disciplined quality management system where every stage is verified before moving to the next. From incoming raw materials to final dispatch, comprehensive inspection and testing ensure every product consistently meets international standards and customer specifications.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">Request Technical Quote <span class="ms-2">{!! $arrow !!}</span></a>
                            <a href="{{ route('home') }}#products" class="com_btn_outline_white">Explore Products</a>
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
                        ENGINEERED FOR CONSISTENT PERFORMANCE
                    </div>
                    <h2 class="section-title inner-title inner-title--md text-start">Quality Built Into Every Manufacturing Stage</h2>
                </div>
                <div class="inner-split-text">
                    <p>Quality at Ratnadeep is not limited to the final inspection. It begins with carefully sourced raw materials, continues through every manufacturing process, and concludes with comprehensive testing before dispatch.</p>
                    <p>Supported by advanced testing facilities and experienced quality professionals, every product is validated for dimensional accuracy, mechanical strength, material integrity, and long-term performance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quality approach -->
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    OUR QUALITY APPROACH
                </div>
                <h2 class="section-title inner-title">Every Product Undergoes A Structured Inspection Process</h2>
            </div>
            <div class="approach-grid">
                @foreach($approach as $step)
                    <div class="approach-card">
                        <span class="approach-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="approach-card-title">{{ $step['title'] }}</h3>
                            <p class="approach-card-text">{{ $step['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Destructive testing -->
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-feature">
                <div class="inner-feature-copy">
                    <div class="inner-feature-head">
                        <div class="section-badge">
                            <span class="badge-dot purple-dot"></span>
                            DESTRUCTIVE TESTING
                        </div>
                        <h2 class="section-title inner-title">Mechanical &amp; Metallurgical Performance Validation</h2>
                        <p class="testing-desc">Products are subjected to destructive testing to evaluate strength, ductility, weld integrity, and material behaviour under demanding operating conditions.</p>
                    </div>
                    <div class="testing-lists">
                        @foreach(array_chunk($destructive, (int) ceil(count($destructive) / 2)) as $column)
                            <ul class="testing-list">
                                @foreach($column as $test)
                                    <li>{{ $test }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
                <div class="inner-feature-media">
                    <img src="{{ asset('frontend/assets/images/Inspection/destructive-testing.jpg') }}" alt="Destructive testing at the Ratnadeep laboratory">
                </div>
            </div>
        </div>
    </section>

    <!-- Non-destructive testing -->
    <section class="inner-section">
        <div class="container-fluid">
            <div class="inner-feature inner-feature--reverse">
                <div class="inner-feature-media">
                    <img src="{{ asset('frontend/assets/images/Inspection/non-destructive-testing.jpg') }}" alt="Non-destructive testing at the Ratnadeep facility">
                </div>
                <div class="inner-feature-copy">
                    <div class="inner-feature-head">
                        <div class="section-badge">
                            <span class="badge-dot purple-dot"></span>
                            NON-DESTRUCTIVE TESTING
                        </div>
                        <h2 class="section-title inner-title">Advanced Inspection Without Material Damage</h2>
                        <p class="testing-desc">Advanced non-destructive testing techniques verify internal soundness, dimensional accuracy, and product integrity while preserving the finished component.</p>
                    </div>
                    <div class="testing-lists">
                        @foreach(array_chunk($nonDestructive, (int) ceil(count($nonDestructive) / 2)) as $column)
                            <ul class="testing-list">
                                @foreach($column as $test)
                                    <li>{{ $test }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
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
                    TESTING CAPABILITIES
                </div>
                <h2 class="section-title inner-title">Precision Verified Through Advanced Inspection</h2>
            </div>
            <p class="inner-lead inner-lead--center capabilities-text" style="max-width:1536px;">Every testing procedure at Ratnadeep is carried out using <strong>calibrated equipment, advanced testing technologies, and standardized inspection methods to ensure</strong> consistent and dependable performance. Our comprehensive testing program covers critical quality parameters at every stage, helping identify and eliminate potential defects before the products reach our customers. With a strong focus on <strong>accuracy, safety, reliability, and consistency,</strong> Ratnadeep maintains stringent quality controls to meet demanding industrial requirements. These robust testing practices enable us to consistently deliver products that comply with <strong>global quality standards and customer specifications</strong>, ensuring long-term performance and reliability across diverse industrial applications.</p>
        </div>
    </section>

    <!-- Why Ratnadeep quality -->
    <section class="inner-section">
        <div class="container">
            <div class="inner-badge-wrap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    WHY RATNADEEP QUALITY
                </div>
                <h2 class="section-title inner-title">Confidence Backed By Process, Precision &amp; Proof</h2>
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
