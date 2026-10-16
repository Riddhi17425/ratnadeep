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
                    <img src="{{ pt_image('careers.hero_image') }}" alt="" class="inner-hero-image">
                </div>
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="inner-hero-headline">
                        <div class="hero-badge">
                            <span class="badge-dot"></span>
                            <span>{{ pt('careers.hero_badge') }}</span>
                        </div>
                        <h1 class="hero-title">{{ pt('careers.hero_title') }}</h1>
                    </div>
                    <div class="inner-hero-copy">
                        <p class="hero-subtitle">{{ pt('careers.hero_subtitle') }}</p>
                        <div class="hero-buttons">
                            <a href="#open-roles" class="com_btn_red">{{ pt('careers.hero_button') }} <span class="ms-2">{!! $arrow !!}</span></a>
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
                        {{ pt('careers.intro_badge') }}
                    </div>
                    <h2 class="section-title inner-title inner-title--md text-start">{{ ptl('careers.intro_title') }}</h2>
                </div>
                <div class="inner-split-text">
                    <p>{{ pt('careers.intro_text_1') }}</p>
                    <p>{{ pt('careers.intro_text_2') }}</p>
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
                    {{ pt('careers.roles_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('careers.roles_title') }}</h2>
                @if(pt('careers.roles_note') !== '')
                    <p class="inner-lead inner-lead--center">{{ pt('careers.roles_note') }}</p>
                @endif
            </div>

            @if($roles->isNotEmpty())
                <div class="inner-filters inner-head careers-filters" role="tablist" aria-label="Filter roles by area">
                    <button type="button" class="inner-filter is-active" data-filter="all">All areas</button>
                    @foreach($areas as $area)
                        <button type="button" class="inner-filter" data-filter="{{ \Illuminate\Support\Str::slug($area) }}">{{ $area }}</button>
                    @endforeach
                </div>

                <div class="careers-roles-list">
                    @foreach($roles as $role)
                        <article class="careers-role" data-area="{{ \Illuminate\Support\Str::slug($role->area) }}">
                            <div class="careers-role-copy">
                                <div>
                                    <h3 class="careers-role-title">{{ $role->title }}</h3>
                                    @if($role->department)<p class="careers-role-dept">{{ $role->department }}</p>@endif
                                </div>
                                <div class="careers-role-meta">
                                    <div>
                                        <span class="careers-role-label">Location</span>
                                        <p class="careers-role-value">{{ $role->location }}</p>
                                    </div>
                                    <div>
                                        <span class="careers-role-label">Experience Required</span>
                                        <p class="careers-role-value">{{ $role->experience }}</p>
                                    </div>
                                    <div>
                                        <span class="careers-role-label">Qualifications</span>
                                        <p class="careers-role-value">{{ $role->qualification }}</p>
                                    </div>
                                </div>
                            </div>
                            <a href="#apply" class="com_btn_red js-apply-role" data-role="{{ $role->title }}">Apply Now <span class="ms-2">{!! $arrow !!}</span></a>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="inner-lead inner-lead--center careers-empty">{{ pt('careers.roles_empty') }}</p>
            @endif
        </div>
    </section>

    <!-- Why Join -->
    @if($reasons->isNotEmpty())
    <section class="inner-section careers-why">
        <div class="container">
            <div class="inner-badge-wrap inner-head">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('careers.why_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('careers.why_title') }}</h2>
            </div>
            <div class="num-grid">
                @foreach($reasons as $reason)
                    <div class="num-card">
                        <span class="num-card-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="num-card-title">{{ $reason->title }}</h3>
                            <p class="num-card-text">{{ $reason->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Application Form -->
    <section class="inner-section careers-apply" id="apply">
        <div class="container">
            <div class="inner-badge-wrap inner-head">
                <div class="inner-badge-wrap">
                    <div class="section-badge">
                        <span class="badge-dot purple-dot"></span>
                        {{ pt('careers.apply_badge') }}
                    </div>
                    <h2 class="section-title inner-title inner-title--md text-start">{{ pt('careers.apply_title') }}</h2>
                </div>
                <p class="inner-lead inner-lead--center">{{ ptl('careers.apply_text') }}</p>
            </div>

            @if(session('careers_success'))
                <div class="careers-alert careers-alert--success" role="status">{{ session('careers_success') }}</div>
            @endif
            @if(session('careers_error'))
                <div class="careers-alert careers-alert--error" role="alert">{{ session('careers_error') }}</div>
            @endif
            @if($errors->any())
                <div class="careers-alert careers-alert--error" role="alert">
                    <strong>Please fix the following:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="careers-form" action="{{ route('careers.apply') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="careers-form-grid">
                    <div class="careers-field">
                        <label for="career_full_name">Full Name *:</label>
                        <input type="text" name="full_name" id="career_full_name" placeholder="Enter your Full Name" value="{{ old('full_name') }}" required maxlength="255">
                    </div>
                    <div class="careers-field">
                        <label for="career_email">Email ID *:</label>
                        <input type="email" name="email" id="career_email" placeholder="Enter your Email Id" value="{{ old('email') }}" required maxlength="255">
                    </div>
                    <div class="careers-field">
                        <label for="career_phone">Phone Number *:</label>
                        <input type="tel" name="phone" id="career_phone" placeholder="Enter your Phone Number" value="{{ old('phone') }}" required minlength="7" maxlength="15" pattern="[0-9]{7,15}" inputmode="numeric" title="Enter a phone number using 7 to 15 digits.">
                    </div>
                    <div class="careers-field">
                        <label for="career_position">Position Applied For *:</label>
                        <select name="position" id="career_position" required>
                            <option value="" {{ old('position') ? '' : 'selected' }} disabled>Select Specific Mill / Office Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->title }}" {{ old('position') === $role->title ? 'selected' : '' }}>{{ $role->title }}</option>
                            @endforeach
                            <option value="General application" {{ old('position') === 'General application' ? 'selected' : '' }}>General application</option>
                        </select>
                        <svg class="careers-select-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L5 5L9 1" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div class="careers-field">
                        <label for="career_experience">Total Relevant Experience *:</label>
                        <input type="text" name="experience" id="career_experience" placeholder="Enter your Experience" value="{{ old('experience') }}" required maxlength="255">
                    </div>
                    <div class="careers-field">
                        <label for="career_linkedin">LinkedIn Profile :</label>
                        <input type="text" name="linkedin" id="career_linkedin" placeholder="LinkedIn Profile:" value="{{ old('linkedin') }}" maxlength="255">
                    </div>
                    <div class="careers-field">
                        <label for="career_resume">Upload Resume * :</label>
                        <label for="career_resume" class="careers-upload">
                            <svg width="28" height="35" viewBox="0 0 28 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.5 1H4a3 3 0 0 0-3 3v27a3 3 0 0 0 3 3h20a3 3 0 0 0 3-3V11.5L16.5 1Z" stroke="#413185" stroke-width="2" stroke-linejoin="round"/><path d="M16 1v11h11M14 28V16m0 0-4.5 4.5M14 16l4.5 4.5" stroke="#413185" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span id="career_resume_label">Attach Your Resume In PDF, Word Format</span>
                            <strong>Max Size: 5 Mb</strong>
                            <input type="file" name="resume" id="career_resume" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                        </label>
                    </div>
                </div>
                <div class="careers-form-actions">
                    <button type="submit" class="com_btn_red careers-submit"><span class="careers-submit-label">Submit</span> <span class="ms-2">{!! $arrow !!}</span></button>
                </div>
            </form>
        </div>
    </section>

    <!-- Locations -->
    @if($locations->isNotEmpty())
    <section class="inner-section careers-locations">
        <div class="container">
            <div class="inner-badge-wrap inner-head">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt('careers.locations_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt('careers.locations_title') }}</h2>
            </div>
            <div class="careers-locations-grid">
                @foreach($locations as $location)
                    <div class="careers-location-card">
                        <h3 class="careers-location-title">{{ $location->title }}</h3>
                        <p class="careers-location-address">{{ $location->description }}</p>
                        @if($location->phone)
                            <div class="careers-location-meta">
                                <span class="careers-location-label">Contact us:</span>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $location->phone) }}">{{ $location->phone }}</a>
                            </div>
                        @endif
                        @if($location->email)
                            <div class="careers-location-meta">
                                <span class="careers-location-label">Email us:</span>
                                <a href="mailto:{{ $location->email }}">{{ $location->email }}</a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="inner-section inner-section--last">
        <div class="container-fluid">
            <div class="page-cta">
                <img src="{{ asset('frontend/assets/images/Common/cta-bg.png') }}" alt="" class="page-cta-image" aria-hidden="true">
                <div class="page-cta-inner">
                    <div class="page-cta-copy">
                        <h2 class="page-cta-title">{{ pt('careers.cta_title') }}</h2>
                        <p class="page-cta-text">{{ pt('careers.cta_text') }}</p>
                    </div>
                    <div class="page-cta-actions">
                        <a href="#open-roles" class="com_btn_red">{{ pt('careers.cta_button_1') }}</a>
                        <a href="#apply" class="com_btn_outline_white">{{ pt('careers.cta_button_2') }}</a>
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

    // show the chosen resume file name
    var fileInput = document.getElementById('career_resume');
    var fileLabel = document.getElementById('career_resume_label');
    var careersForm = document.querySelector('.careers-form');
    var submitButton = careersForm ? careersForm.querySelector('.careers-submit') : null;
    if (fileInput && fileLabel) {
        fileInput.addEventListener('change', function () {
            fileLabel.textContent = fileInput.files.length ? fileInput.files[0].name : 'Attach Your Resume In PDF, Word Format';
        });
    }

    if (careersForm && fileInput && submitButton) {
        $.validator.addMethod('careerResumeSize', function (value, element) {
            return this.optional(element) || element.files[0].size <= 5 * 1024 * 1024;
        }, 'The resume may not be larger than 5 MB.');

        $('#career_phone').on('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 15);
        });

        $(careersForm).validate({
            ignore: ':hidden:not(#career_resume)',
            errorElement: 'span',
            errorClass: 'careers-validation-error',
            errorPlacement: function (error, element) {
                if (element.attr('type') === 'file') {
                    error.insertAfter(element.closest('.careers-upload'));
                    return;
                }

                error.insertAfter(element);
            },
            rules: {
                full_name: { required: true, maxlength: 255 },
                email: { required: true, email: true, maxlength: 255 },
                phone: { required: true, digits: true, minlength: 7, maxlength: 15 },
                position: { required: true },
                experience: { required: true, maxlength: 255 },
                linkedin: { maxlength: 255 },
                resume: { required: true, extension: 'pdf|doc|docx', careerResumeSize: true }
            },
            messages: {
                email: { email: 'Please enter a valid email address.' },
                position: { required: 'Please select a position.' },
                resume: { extension: 'Please attach your resume as a PDF or Word file.' }
            },
            submitHandler: function (form) {
                submitButton.disabled = true;
                submitButton.setAttribute('aria-busy', 'true');
                submitButton.querySelector('.careers-submit-label').textContent = 'Submitting...';
                form.submit();
                return false;
            }
        });
    }

    // after a submit (success or errors) land on the form
    @if(session('careers_success') || session('careers_error') || $errors->any())
        var apply = document.getElementById('apply');
        if (apply) { apply.scrollIntoView(); }
    @endif
});
</script>
@endpush

@push('scripts')
<script src="{{ asset('frontend/assets/js/inner-animations.js') }}?v={{ filemtime(public_path('frontend/assets/js/inner-animations.js')) }}"></script>
@endpush
