@extends('front.layouts.main')

@section('title', 'Contact Us | Ratnadeep Metal & Tubes Ltd.')

@section('page_css')
<link rel="stylesheet" href="{{ asset('frontend/assets/css/contact.css') }}">
@endsection

@section('content')
<main class="page-contact">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--contact container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <img src="{{ asset('frontend/assets/images/Contact/contact-hero.png') }}" alt="" class="inner-hero-image">
                <div class="inner-hero-overlay"></div>
            </div>
            <div class="container hero-content-wrapper h-100 position-relative">
                <div class="hero-content">
                    <div class="hero-badge">
                        <span class="badge-dot"></span>
                        <span>CONNECT WITH US</span>
                    </div>
                    <h1 class="hero-title">Your Manufacturing Requirement.<br>Our Commitment.</h1>
                    <p class="hero-subtitle">Reach out to Ratnadeep Metal And Tubes Limited for pipe and tube manufacturing solutions, technical support, or project enquiries. From product selection to timely delivery, our team is here to help.</p>
                    <div class="hero-buttons">
                        <a href="#write-to-us" class="com_btn_red">Request a Technical Quote <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                        <a href="{{ route('home') }}#products" class="com_btn_outline_white">Explore Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Write To Us -->
    <section class="mt_80" id="write-to-us">
        <div class="container">
            <div class="contact-form-grid">
                <div class="contact-form-col">
                    <div class="contact-form-intro">
                        <div class="section-badge align-left">
                            <span class="badge-dot purple-dot"></span>
                            WRITE TO US
                        </div>
                        <h2 class="section-title text-start contact-form-title">Let's Discuss Your Requirements</h2>
                    </div>

                    <form class="quote-form" id="contact-enquiry-form" action="{{ route('contact.submit') }}" method="POST">

                    @csrf

                    <div class="form-row">

                        <div class="form-group">

                            <label>Full Name <span class="text-danger">*</span></label>

                            <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s{2,}/g, ' ').trimStart();">

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label>Company</label>

                            <input type="text" name="company" placeholder="Company name"
                                value="{{ old('company') }}">

                            @error('company')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" placeholder="john@company.com"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                       <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input type="tel" id="phone" placeholder="99999 99999" value="{{ old('phone') }}" required title="Please add Phone Number">
                        <input type="hidden" name="phone" id="phone_number">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Country <span class="text-danger">*</span></label>
                            <select name="country" id="country">
                                <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select Country
                                </option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}"
                                        {{ old('country') === $country->name ? 'selected' : '' }}>{{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                        <div class="form-group">
                            <label>City <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="city" placeholder="Ahmedabad"
                                value="{{ old('city') }}"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s{2,}/g, ' ').trimStart();">
                            @error('city')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Product</label>
                            <select name="product">
                                <option value="" disabled {{ old('product') ? '' : 'selected' }}>Select Product
                                </option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->title }}"
                                        {{ old('product') === $product->title ? 'selected' : '' }}>
                                        {{ $product->title }}</option>
                                @endforeach
                                <option value="Other" {{ old('product') === 'Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            @error('product')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">

                        <label>Requirement Details</label>

                        <textarea name="requirement_details"
                            placeholder="Describe your project requirement....">{{ old('requirement_details') }}</textarea>

                        @error('requirement_details')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <button type="submit" class="com_btn" id="contactSubmitBtn">

                        Get Quote <svg class="ms-2" width="18" height="18" viewBox="0 0 18 18"
                            fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path
                                d="M10.3767 15.4809C10.4038 15.5485 10.451 15.6062 10.5118 15.6462C10.5727 15.6862 10.6443 15.7067 10.7171 15.7048C10.7899 15.7029 10.8604 15.6788 10.9191 15.6358C10.9779 15.5927 11.022 15.5327 11.0456 15.4638L15.6858 1.90015C15.7087 1.8369 15.713 1.76844 15.6984 1.7028C15.6837 1.63716 15.6507 1.57704 15.6032 1.52949C15.5556 1.48193 15.4955 1.44891 15.4298 1.43427C15.3642 1.41963 15.2958 1.42399 15.2325 1.44684L1.66888 6.08702C1.59999 6.11065 1.53998 6.15478 1.49689 6.2135C1.45381 6.27222 1.42972 6.34271 1.42785 6.41552C1.42599 6.48832 1.44644 6.55996 1.48646 6.62081C1.52648 6.68165 1.58416 6.7288 1.65175 6.75592L7.31278 9.02604C7.49174 9.09769 7.65433 9.20484 7.79076 9.34103C7.92719 9.47721 8.03463 9.63962 8.10661 9.81845L10.3767 15.4809Z"
                                stroke="white" stroke-width="1.42775" stroke-linecap="round"
                                stroke-linejoin="round" />

                            <path d="M15.6008 1.53223L7.79102 9.3413" stroke="white" stroke-width="1.42775"
                                stroke-linecap="round" stroke-linejoin="round" />

                        </svg>

                    </button>

                    <p class="form-footer">Our team typically responds within 24 business hours.</p>

                </form>

                </div>
                <div class="contact-map-col">
                    <div class="contact-map-wrap">
                        <iframe 
                            class="contact-map-iframe" title="Ratnadeep Metal And Tubes Location - Mumbai" src="https://maps.google.com/maps?q=110%2C%20Gujrat%2C%20196%2F198%2C%20Khetwadi%20Back%20Road%2C%20Opp.%2013th%20Khetwadi%20Lane%2C%20Mumbai%20-%20400%20004%2C%20India&hl=en&z=16&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reach Us -->
    <section class="mt_80 contact-locations-section">
        <div class="container">
            <div class="text-center section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    REACH US
                </div>
                <h2 class="section-title">Our Locations &amp; Contacts</h2>
            </div>
            <div class="contact-locations-grid">
                <div class="contact-location-card">
                    <h3 class="contact-location-title">Registered Office</h3>
                    <p class="contact-location-address">402, Sai Prasad Apartment, Usmanpura, Ahmedabad – 380 013, Gujarat, India.</p>
                    <div class="contact-location-meta">
                        <span class="contact-location-label">Contact us:</span>
                        <a href="tel:+918238092054">+91 82380 92054</a>
                    </div>
                    <div class="contact-location-meta">
                        <span class="contact-location-label">Email us:</span>
                        <a href="mailto:ro@ratnadeepmetal.com">ro@ratnadeepmetal.com</a>
                    </div>
                </div>
                <div class="contact-location-card">
                    <h3 class="contact-location-title">Corporate Office:</h3>
                    <p class="contact-location-address">102, "Rajgiri", 196/198, Khetwadi Back Road, Mumbai – 400 004, Maharashtra, India.</p>
                    <div class="contact-location-meta">
                        <span class="contact-location-label">Contact us:</span>
                        <a href="tel:02266362742">022-66362742</a>
                    </div>
                    <div class="contact-location-meta">
                        <span class="contact-location-label">Email us:</span>
                        <a href="mailto:info@ratnadeepmetal.com">info@ratnadeepmetal.com</a>
                    </div>
                </div>
                <div class="contact-location-card">
                    <h3 class="contact-location-title">Manufacturing site:</h3>
                    <p class="contact-location-address">Survey No. 1015, Village Rajpur, Taluka Kadi, District Mehsana - 382 715, Gujarat, India.</p>
                    <div class="contact-location-meta">
                        <span class="contact-location-label">Contact us:</span>
                        <a href="tel:+919724303768">+91 97243 03768</a>
                    </div>
                    <div class="contact-location-meta">
                        <span class="contact-location-label">Email us:</span>
                        <a href="mailto:works@ratnadeepmetal.com">works@ratnadeepmetal.com</a>
                    </div>
                </div>
                <div class="contact-location-card">
                    <h3 class="contact-location-title">Europe Sales:</h3>
                    <p class="contact-location-address">Gritec Metals, S.L. Calle Barroso 6, 3a 29001 Málaga Spain</p>
                    <div class="contact-location-meta">
                        <span class="contact-location-label">Contact us:</span>
                        <a href="tel:+34656727439">+34 656 727439</a>
                    </div>
                    <div class="contact-location-meta">
                        <span class="contact-location-label">Email us:</span>
                        <a href="mailto:sales@gritecmetals.com">sales@gritecmetals.com</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Careers -->
    <section class="mt_80 contact-careers-section">
        <div class="container">
            <div class="text-center section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    Careers at Ratnadeep
                </div>
                <h2 class="section-title">Careers at Ratnadeep</h2>
                <p class="contact-careers-lead">Bring your expertise to a team driven by engineering precision, manufacturing discipline, and continuous improvement.</p>
                <a href="#write-to-us" class="com_btn_red">Join Our Team <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
            </div>
            <div class="contact-careers-gallery">
                <div class="contact-career-card contact-career-card--left">
                    <img src="{{ asset('frontend/assets/images/About/career-1.png') }}" alt="Ratnadeep team meeting" class="img-fluid w-100">
                </div>
                <div class="contact-career-card contact-career-card--center">
                    <img src="{{ asset('frontend/assets/images/About/career-2.png') }}" alt="" class="contact-career-layer contact-career-layer--bg" aria-hidden="true">
                    <img src="{{ asset('frontend/assets/images/About/career-2-overlay.png') }}" alt="Ratnadeep workforce at manufacturing facility" class="contact-career-layer contact-career-layer--fg">
                </div>
                <div class="contact-career-card contact-career-card--right">
                    <img src="{{ asset('frontend/assets/images/About/career-3.png') }}" alt="Ratnadeep team collaboration" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

<script>
    $(document).ready(function () {
        let isProductSubmitting = false;

        $('#contact-enquiry-form').on('submit', function (e) {
            e.preventDefault();

            if (isProductSubmitting) {
                return;
            }

            const form = this;
            const $form = $(form);
            const $button = $('#productSubmitBtn');
            const $message = $('#popup-enquiry-message');

            // Remove errors from the previous submission.
            $form.find('.server-validation-error').remove();

            $message.hide().removeClass('text-success text-danger').text('');

            isProductSubmitting = true;

            $button.prop('disabled', true).text('Submitting...');

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },

                success: function (response) {
                    if (response.success) {
                        $message
                            .addClass('text-success')
                            .text(response.message)
                            .show();

                        form.reset();

                        // Allow the product field to be populated again
                        // when another product is selected.
                        $('#popup-product-name').val('');
                    } else {
                        $message
                            .addClass('text-danger')
                            .text(response.message || 'Please try again.')
                            .show();
                    }
                },

                error: function (xhr) {
                    if (xhr.status === 422 && xhr.responseJSON) {
                        const errors = xhr.responseJSON.errors || {};

                        $.each(errors, function (field, messages) {
                            const $input = $form.find('[name="' + field + '"]');

                            if ($input.length && messages.length) {
                                const $error = $('<div>', {
                                    class: 'server-validation-error text-danger'
                                }).text(messages[0]);

                                $input.closest('.form-group').append($error);
                            }
                        });

                        $message
                            .addClass('text-danger')
                            .text(xhr.responseJSON.message || 'Please correct the errors.')
                            .show();
                    } else {
                        $message
                            .addClass('text-danger')
                            .text(
                                xhr.responseJSON?.message ||
                                'Unable to submit your enquiry. Please try again.'
                            )
                            .show();
                    }
                },

                complete: function () {
                    isProductSubmitting = false;

                    $button.prop('disabled', false).text('Send Enquiry');
                }
            });
        });
    });
</script>