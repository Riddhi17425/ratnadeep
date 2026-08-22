<?php
$page_title = 'Contact Us';
$page_css = 'assets/css/contact.css';
include 'includes/header.php';

$arrow_icon = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$select_arrow = '<svg class="contact-select-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L5 5L9 1" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>

<main class="page-contact">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--contact container-fluid position-relative p-0">
        <div class="inner-hero-bg h-100 position-relative">
            <div class="inner-hero-media" aria-hidden="true">
                <img src="assets/images/Contact/contact-hero.png" alt="" class="inner-hero-image">
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
                        <a href="#write-to-us" class="com_btn_red">Request a Technical Quote <span class="ms-2"><?php echo $arrow_icon; ?></span></a>
                        <a href="index.php#products" class="com_btn_outline_white">Explore Products</a>
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
                    <form class="contact-form" action="#" method="post">
                        <div class="contact-form-row">
                            <div class="contact-field">
                                <input type="text" name="full_name" id="full_name" placeholder="Full Name*:" required>
                            </div>
                            <div class="contact-field">
                                <input type="text" name="company_name" id="company_name" placeholder="Company Name*:" required>
                            </div>
                        </div>
                        <div class="contact-form-row">
                            <div class="contact-field">
                                <input type="tel" name="phone" id="phone" placeholder="Phone Number*:" required>
                            </div>
                            <div class="contact-field">
                                <input type="email" name="email" id="email" placeholder="Email Address*:" required>
                            </div>
                        </div>
                        <div class="contact-form-row">
                            <div class="contact-field contact-field--select">
                                <select name="city" id="city" required>
                                    <option value="" selected disabled>City*:</option>
                                    <option value="mumbai">Mumbai</option>
                                    <option value="ahmedabad">Ahmedabad</option>
                                    <option value="mehsana">Mehsana</option>
                                    <option value="other">Other</option>
                                </select>
                                <?php echo $select_arrow; ?>
                            </div>
                            <div class="contact-field contact-field--select">
                                <select name="state" id="state" required>
                                    <option value="" selected disabled>State*:</option>
                                    <option value="maharashtra">Maharashtra</option>
                                    <option value="gujarat">Gujarat</option>
                                    <option value="other">Other</option>
                                </select>
                                <?php echo $select_arrow; ?>
                            </div>
                        </div>
                        <div class="contact-form-row">
                            <div class="contact-field contact-field--full">
                                <input type="text" name="requirement" id="requirement" placeholder="Requirement :">
                            </div>
                        </div>
                        <div class="contact-form-actions">
                            <button type="submit" class="com_btn_red contact-submit-btn">Submit <span class="ms-2"><?php echo $arrow_icon; ?></span></button>
                        </div>
                    </form>
                </div>
                <div class="contact-map-col">
                    <div class="contact-map-wrap">
                        <iframe
                            class="contact-map-iframe"
                            title="Ratnadeep Metal And Tubes manufacturing site location"
                            src="https://maps.google.com/maps?q=Survey+No.+1015,+Village+Rajpur,+Taluka+Kadi,+District+Mehsana,+382715,+Gujarat,+India&amp;hl=en&amp;z=14&amp;output=embed"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            allowfullscreen>
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
                    <p class="contact-location-address">Survey No. 1015, Village Rajpur, Taluka Kadi, District Mehsana – 382 715, Gujarat, India.</p>
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
                <a href="#write-to-us" class="com_btn_red">Join Our Team <span class="ms-2"><?php echo $arrow_icon; ?></span></a>
            </div>
            <div class="contact-careers-gallery">
                <div class="contact-career-card contact-career-card--left">
                    <img src="assets/images/About/career-1.png" alt="Ratnadeep team meeting" class="img-fluid w-100">
                </div>
                <div class="contact-career-card contact-career-card--center">
                    <img src="assets/images/About/career-2.png" alt="" class="contact-career-layer contact-career-layer--bg" aria-hidden="true">
                    <img src="assets/images/About/career-2-overlay.png" alt="Ratnadeep workforce at manufacturing facility" class="contact-career-layer contact-career-layer--fg">
                </div>
                <div class="contact-career-card contact-career-card--right">
                    <img src="assets/images/About/career-3.png" alt="Ratnadeep team collaboration" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
