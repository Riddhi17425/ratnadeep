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
                            <a href="{{ route('products') }}" class="com_btn_outline_white">Explore Products</a>
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
                @forelse($events as $event)
                    <article class="events-listing-card">
                        @if($event->icon)
                            <div class="events-listing-image">
                                <img src="{{ asset($event->icon) }}" alt="{{ $event->alt_icon_text ?: $event->title }}" class="img-fluid w-100">
                            </div>
                        @endif
                        <div class="events-listing-body">
                            @if($event->date_from)
                                <time class="events-listing-date" datetime="{{ $event->date_from->format('Y-m-d') }}">
                                    {{ $event->date_from->format('F d, Y') }}@if($event->date_to && !$event->date_to->equalTo($event->date_from)) - {{ $event->date_to->format('F d, Y') }}@endif
                                </time>
                            @endif
                            <h2 class="events-listing-title">{{ $event->title }}</h2>
                            @if($event->short_description)
                                <div class="events-listing-desc">{!! $event->short_description !!}</div>
                            @endif
                            @if($event->reference)
                                <p class="events-listing-contact">
                                    Contact Ref:
                                    @if(filter_var($event->reference, FILTER_VALIDATE_EMAIL))
                                        <a href="mailto:{{ $event->reference }}">{{ $event->reference }}</a>
                                    @elseif(filter_var($event->reference, FILTER_VALIDATE_URL) && in_array(parse_url($event->reference, PHP_URL_SCHEME), ['http', 'https'], true))
                                        <a href="{{ $event->reference }}">{{ $event->reference }}</a>
                                    @else
                                        {{ $event->reference }}
                                    @endif
                                </p>
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="events-listing-empty">There are no events to display at the moment.</p>
                @endforelse
            </div>
        </div>
    </section>
</main>
@endsection
