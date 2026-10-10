@extends('front.layouts.main')

@section('title', 'Careers | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/inner-common.css') }}?v={{ filemtime(public_path('frontend/assets/css/inner-common.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/careers.css') }}?v={{ filemtime(public_path('frontend/assets/css/careers.css')) }}">
@endsection

@section('content')
@php
    $arrow = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
@endphp
<main class="page-inner page-careers">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--split inner-hero-section--careers container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <div class="inner-hero-media-inner">
                    <img src="{{ asset('frontend/assets/images/Careers/careers-hero.jpg') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>CAREERS</span>
                        </div>
                        <h1 class="hero-title">Careers at Ratnadeep</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">Bring your expertise to a workplace shaped by engineering precision, manufacturing discipline and continuous improvement.</p>
                        <div class="hero-buttons">
                            <a href="#open-roles" class="com_btn_red">View Open Roles <span class="ms-2">{!! $arrow !!}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Workplace -->
    <section class="inner-section careers-intro">
        <div class="container">
            <div class="inner-split">
                <div class="inner-badge-wrap inner-badge-wrap--left">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        OUR WORKPLACE
                    </div>
                    <h2 class="section-title inner-title inner-title--md text-start">Careers Grounded<br>in Manufacturing</h2>
                </div>
                <div class="inner-split-text">
                    <p>At Ratnadeep Metal &amp; Tubes Ltd., we manufacture high-precision seamless stainless steel, titanium, and nickel alloy tubes and pipes for critical global applications across nuclear energy, aerospace, offshore oil &amp; gas, cryogenic systems, and chemical processing plants.</p>
                    <p>We operate an integrated manufacturing mill incorporating cold pilgering, draw benches, vacuum bright annealing, and full-spectrum non-destructive testing lines. We seek dedicated technical professionals who value mechanical precision, uncompromising metallurgical rigor, and heavy-industry craftsmanship.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Open Roles -->
    <section class="inner-section careers-roles" id="open-roles">
        <div class="container">
            <div class="inner-badge-wrap inner-head">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    OPEN OPPORTUNITIES
                </div>
                <h2 class="section-title inner-title">Active Technical &amp; Operational Roles</h2>
                <p class="inner-lead inner-lead--center">The roles below are neutral sample content for layout preview and do not represent confirmed vacancies.</p>
            </div>

            <div class="inner-filters inner-head careers-filters" role="tablist" aria-label="Filter roles by area">
                <button type="button" class="inner-filter is-active" data-filter="all">All areas</button>
                @foreach($areas as $area)
                    <button type="button" class="inner-filter" data-filter="{{ \Illuminate\Support\Str::slug($area) }}">{{ $area }}</button>
                @endforeach
            </div>

            <div class="careers-roles-list">
                @foreach($roles as $role)
                    <article class="careers-role" data-area="{{ \Illuminate\Support\Str::slug($role['area']) }}">
                        <div class="careers-role-copy">
                            <div>
                                <h3 class="careers-role-title">{{ $role['title'] }}</h3>
                                <p class="careers-role-dept">{{ $role['department'] }}</p>
                            </div>
                            <div class="careers-role-meta">
                                <div>
                                    <span class="careers-role-label">Location</span>
                                    <p class="careers-role-value">{{ $role['location'] }}</p>
                                </div>
                                <div>
                                    <span class="careers-role-label">Experience Required</span>
                                    <p class="careers-role-value">{{ $role['experience'] }}</p>
                                </div>
                                <div>
                                    <span class="careers-role-label">Qualifications</span>
                                    <p class="careers-role-value">{{ $role['qualification'] }}</p>
                                </div>
                            </div>
                        </div>
                        <a href="#apply" class="com_btn_red js-apply-role" data-role="{{ $role['title'] }}">Apply Now <span class="ms-2">{!! $arrow !!}</span></a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Join -->
    <section class="inner-section careers-why">
        <div class="container">
            <div class="inner-badge-wrap inner-head">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    WHY JOIN RATNADEEP
                </div>
                <h2 class="section-title inner-title">A Place to Learn the Work, Then Improve It</h2>
            </div>
            <div class="num-grid">
                @foreach($reasons as $reason)
                    <div class="num-card">
                        <span class="num-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="num-card-title">{{ $reason['title'] }}</h3>
                            <p class="num-card-text">{{ $reason['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Application Form -->
    <section class="inner-section careers-apply" id="apply">
        <div class="container">
            <div class="inner-badge-wrap inner-head">
                <div class="inner-badge-wrap">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        OUR WORKPLACE
                    </div>
                    <h2 class="section-title inner-title inner-title--md text-start">Submit Your Application</h2>
                </div>
                <p class="inner-lead inner-lead--center">Your Next Opportunity Could Start Here.<br>We are always interested in connecting with qualified engineers, technicians and operations professionals who want to build their careers in precision manufacturing. Share your profile with our HR team for consideration across current and upcoming opportunities at Ratnadeep.</p>
            </div>

            <form class="careers-form" action="#" method="post" enctype="multipart/form-data">
                @csrf
                <div class="careers-form-grid">
                    <div class="careers-field">
                        <label for="career_full_name">Full Name *:</label>
                        <input type="text" name="full_name" id="career_full_name" placeholder="Enter your Full Name" required>
                    </div>
                    <div class="careers-field">
                        <label for="career_email">Email ID *:</label>
                        <input type="email" name="email" id="career_email" placeholder="Enter your Email Id" required>
                    </div>
                    <div class="careers-field">
                        <label for="career_phone">Phone Number *:</label>
                        <input type="tel" name="phone" id="career_phone" placeholder="Enter your Phone Number" required>
                    </div>
                    <div class="careers-field">
                        <label for="career_position">Position Applied For *:</label>
                        <select name="position" id="career_position" required>
                            <option value="" selected disabled>Select Specific Mill / Office Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role['title'] }}">{{ $role['title'] }}</option>
                            @endforeach
                        </select>
                        <svg class="careers-select-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L5 5L9 1" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div class="careers-field">
                        <label for="career_experience">Total Relevant Experience *:</label>
                        <input type="text" name="experience" id="career_experience" placeholder="Enter your Experience" required>
                    </div>
                    <div class="careers-field">
                        <label for="career_linkedin">LinkedIn Profile :</label>
                        <input type="text" name="linkedin" id="career_linkedin" placeholder="LinkedIn Profile:">
                    </div>
                    <div class="careers-field">
                        <label for="career_resume">Upload Resume * :</label>
                        <label for="career_resume" class="careers-upload">
                            <svg width="28" height="35" viewBox="0 0 28 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.5 1H4a3 3 0 0 0-3 3v27a3 3 0 0 0 3 3h20a3 3 0 0 0 3-3V11.5L16.5 1Z" stroke="#413185" stroke-width="2" stroke-linejoin="round"/><path d="M16 1v11h11M14 28V16m0 0-4.5 4.5M14 16l4.5 4.5" stroke="#413185" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>Attach Your Resume In PDF, Word Format</span>
                            <strong>Max Size: 5 Mb</strong>
                            <input type="file" name="resume" id="career_resume" accept=".pdf,.doc,.docx" required>
                        </label>
                    </div>
                </div>
                <div class="careers-form-actions">
                    <button type="submit" class="com_btn_red careers-submit">Submit <span class="ms-2">{!! $arrow !!}</span></button>
                </div>
            </form>
        </div>
    </section>

    <!-- Locations -->
    <section class="inner-section careers-locations">
        <div class="container">
            <div class="inner-badge-wrap inner-head">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    REACH US
                </div>
                <h2 class="section-title inner-title">Our Locations &amp; Contacts</h2>
            </div>
            <div class="careers-locations-grid">
                @foreach($locations as $location)
                    <div class="careers-location-card">
                        <h3 class="careers-location-title">{{ $location['title'] }}</h3>
                        <p class="careers-location-address">{{ $location['address'] }}</p>
                        <div class="careers-location-meta">
                            <span class="careers-location-label">Contact us:</span>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $location['phone']) }}">{{ $location['phone'] }}</a>
                        </div>
                        <div class="careers-location-meta">
                            <span class="careers-location-label">Email us:</span>
                            <a href="mailto:{{ $location['email'] }}">{{ $location['email'] }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="inner-section inner-section--last">
        <div class="container-fluid">
            <div class="page-cta">
                <img src="{{ asset('frontend/assets/images/Common/cta-bg.png') }}" alt="" class="page-cta-image" aria-hidden="true">
                <div class="page-cta-inner">
                    <div class="page-cta-copy">
                        <h2 class="page-cta-title">Ready to Bring Your Work to Ratnadeep?</h2>
                        <p class="page-cta-text">Talk to our technical team about your product requirements and project specifications.</p>
                    </div>
                    <div class="page-cta-actions">
                        <a href="#open-roles" class="com_btn_red">View Open Roles</a>
                        <a href="#apply" class="com_btn_outline_white">Share Your Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var filters = document.querySelectorAll('.inner-filter');
    var roles = document.querySelectorAll('.careers-role');
    filters.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filters.forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            var area = btn.getAttribute('data-filter');
            roles.forEach(function (role) {
                role.hidden = area !== 'all' && role.getAttribute('data-area') !== area;
            });
        });
    });

    var select = document.getElementById('career_position');
    document.querySelectorAll('.js-apply-role').forEach(function (link) {
        link.addEventListener('click', function () {
            if (select) { select.value = link.getAttribute('data-role'); }
        });
    });
});
</script>
@endpush

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
