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
                    <img src="{{ asset('frontend/assets/images/Clients/clients-hero.png') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>OUR CLIENTS</span>
                        </div>
                        <h1 class="hero-title">The Trust Behind Every Supply.</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">Ratnadeep Metal And Tubes Limited manufactures seamless and welded pipes and tubes trusted by engineering, energy, and process industries worldwide for consistent quality, dependable supply, and manufacturing excellence.</p>
                        <div class="hero-buttons">
                            <a href="{{ route('contact') }}#write-to-us" class="com_btn_red">Get a Technical Quote <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                            <a href="{{ route('home') }}#products" class="com_btn_outline_white">Browse Our Products</a>
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
                        TRUSTED PARTNERSHIPS
                    </div>
                    <h2 class="clients-intro-title">Built on Performance. Trusted Through Every Project.</h2>
                </div>
                <div class="clients-intro-right">
                    <p>For over four decades, Ratnadeep Metal And Tubes Limited has supplied seamless and welded pipes and tubes to global engineering, energy, EPC, and process industries. Our disciplined manufacturing, rigorous quality assurance, and dependable delivery continue to support projects where consistency matters at every stage.</p>
                    <p>From refineries and petrochemical facilities to power generation, marine, defence, and industrial manufacturing, customers choose us for products backed by complete material traceability, internationally aligned standards, and long-term manufacturing reliability.</p>
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
                    TRUSTED BY THE INDUSTRY
                </div>
                <h2 class="clients-logos-title">Chosen by Enterprises Worldwide</h2>
            </div>

            <div class="clients-logo-grid">
                <div class="clients-logo-column clients-logo-column--offset">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/sabic.svg') }}" alt="SABIC">
                    </div>
                </div>
                <div class="clients-logo-column">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/thyssenkrupp.svg') }}" alt="Thyssenkrupp">
                    </div>
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/reliance.png') }}" alt="Reliance Industries Limited">
                    </div>
                </div>
                <div class="clients-logo-column clients-logo-column--offset">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/tecnicas-reunidas.png') }}" alt="Técnicas Reunidas">
                    </div>
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/linde.png') }}" alt="Linde">
                    </div>
                </div>
                <div class="clients-logo-column">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/jacobs.png') }}" alt="Jacobs">
                    </div>
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/saipem.png') }}" alt="Saipem">
                    </div>
                </div>
                <div class="clients-logo-column clients-logo-column--offset">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/ntpc.svg') }}" alt="NTPC">
                    </div>
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/bhel.png') }}" alt="BHEL">
                    </div>
                </div>
                <div class="clients-logo-column">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/technip.svg') }}" alt="Technip">
                    </div>
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/tecnimont.png') }}" alt="Tecnimont">
                    </div>
                </div>
                <div class="clients-logo-column clients-logo-column--offset">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/eil.svg') }}" alt="Engineers India Limited">
                    </div>
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/thermocables.png') }}" alt="Thermo Cables">
                    </div>
                </div>
                <div class="clients-logo-column">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/valmet.png') }}" alt="Valmet">
                    </div>
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/yaar.png') }}" alt="Yaar">
                    </div>
                </div>
                <div class="clients-logo-column clients-logo-column--offset clients-logo-column--last">
                    <div class="clients-logo-card">
                        <img src="{{ asset('frontend/assets/images/Clients/petrofac.png') }}" alt="Petrofac">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
