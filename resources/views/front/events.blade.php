@extends('front.layouts.main')

@section('title', 'Events | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/events.css') }}">
@endsection

@section('content')
<main class="page-events">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--events container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ asset('frontend/assets/images/Events/events-hero.png') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>UPCOMING EVENTS &amp; EXHIBITIONS</span>
                        </div>
                        <h1 class="hero-title">From international exhibitions to regional trade events</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">Stay updated with our participation in global events, exhibitions, and industry engagements where Ratnadeep showcases advanced tube and pipe manufacturing capabilities.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">Request a Quote <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                            <a href="{{ route('home') }}#products" class="com_btn_outline_white">Explore Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Listing -->
    <section class="events-listing-section" id="events-listing">
        <div class="container">
            <div class="events-listing-grid">
                <article class="events-listing-card">
                    <div class="events-listing-image">
                        <img src="{{ asset('frontend/assets/images/Events/event-card-1.png') }}" alt="Stainless Steel World Middle East" class="img-fluid w-100">
                    </div>
                    <div class="events-listing-body">
                        <time class="events-listing-date" datetime="2020-03-09">March 09, 2020</time>
                        <h2 class="events-listing-title">Stainless Steel World Middle East</h2>
                        <p class="events-listing-desc">We are pleased to inform you all we are going to participate in most reputed expo of the domain “Stainless Steel” in Muscat – Oman. We welcome our clients and industry partners to meet and discuss opportunities in stainless steel and alloy tubes.</p>
                        <p class="events-listing-contact">
                            Contact Ref: <a href="mailto:work@ratnadeepmetal.com">work@ratnadeepmetal.com</a>
                        </p>
                    </div>
                </article>

                <article class="events-listing-card events-listing-card--wide-gap">
                    <div class="events-listing-image">
                        <img src="{{ asset('frontend/assets/images/Events/event-card-2.png') }}" alt="Duesseldorf Germany 2020" class="img-fluid w-100">
                    </div>
                    <div class="events-listing-body">
                        <time class="events-listing-date" datetime="2020-03-30">March 30, 2020</time>
                        <h2 class="events-listing-title">Duesseldorf Germany 2020</h2>
                        <p class="events-listing-desc">We are pleased to inform you all we are going to participate in most reputed expo of the domain “TUBE DUESSELDORF” in Germany. We welcome our clients and global partners to meet and discuss customized tubing solutions.</p>
                        <p class="events-listing-contact">
                            Contact Ref: <a href="mailto:work@ratnadeepmetal.com">work@ratnadeepmetal.com</a>
                        </p>
                    </div>
                </article>

                <article class="events-listing-card events-listing-card--wide-gap">
                    <div class="events-listing-image">
                        <img src="{{ asset('frontend/assets/images/Events/event-card-3.png') }}" alt="Stainless Steel World 2019" class="img-fluid w-100">
                    </div>
                    <div class="events-listing-body">
                        <time class="events-listing-date" datetime="2019-03-30">March 30, 2019</time>
                        <h2 class="events-listing-title">Stainless Steel World 2019</h2>
                        <p class="events-listing-desc">Ratnadeep participated in Stainless Steel World Expo, presenting our precision manufacturing lines, seamless nickel alloy tubes, and certified quality management practices.</p>
                        <p class="events-listing-contact">
                            Contact Ref: <a href="mailto:work@ratnadeepmetal.com">work@ratnadeepmetal.com</a>
                        </p>
                    </div>
                </article>

                <article class="events-listing-card">
                    <div class="events-listing-image">
                        <img src="{{ asset('frontend/assets/images/Events/event-card-4.png') }}" alt="Duesseldorf Germany 2018" class="img-fluid w-100">
                    </div>
                    <div class="events-listing-body">
                        <time class="events-listing-date" datetime="2018-04-16">April 16, 2018</time>
                        <h2 class="events-listing-title">Duesseldorf Germany 2018</h2>
                        <p class="events-listing-desc">We participated in the TUBE DUESSELDORF trade fair in Germany, engaging with international EPC contractors and process engineering leaders.</p>
                        <p class="events-listing-contact">
                            Contact Ref: <a href="mailto:work@ratnadeepmetal.com">work@ratnadeepmetal.com</a>
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>
</main>
@endsection
