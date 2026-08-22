<?php
$page_title = 'About Us';
$page_css = 'assets/css/about.css';
include 'includes/header.php';

$arrow_icon = '<svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>

<main class="page-about">
    <!-- Hero -->
    <section class="inner-hero-section inner-hero-section--about container-fluid position-relative p-0">
        <div class="inner-hero-bg inner-hero-bg--cover h-100 position-relative" style="background-image: var(--hero-gradient), url('assets/images/About/about-hero.png');">
            <div class="container hero-content-wrapper h-100">
                <div class="hero-content">
                    <div class="hero-badge">
                        <span class="badge-dot"></span>
                        <span>MANUFACTURING EXCELLENCE SINCE 1981</span>
                    </div>
                    <h1 class="hero-title">Manufacturing Excellence<br>Strengthened by Experience</h1>
                    <p class="hero-subtitle">For over four decades, Ratnadeep Metal And Tubes Limited has been a trusted pipe and tube manufacturer, delivering seamless and welded pipes and tubes supported by advanced manufacturing infrastructure, in-house testing, and disciplined quality systems for industrial applications across domestic and international markets.</p>
                    <div class="hero-buttons">
                        <a href="#manufacturing" class="com_btn_red">Explore Our Manufacturing <span class="ms-2"><?php echo $arrow_icon; ?></span></a>
                        <a href="#products" class="com_btn_outline_white">View Product Portfolio</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Company -->
    <section class="mt_80" id="manufacturing">
        <div class="container">
            <div class="about-company-grid">
                <div class="about-company-intro">
                    <div class="section-badge align-left">
                        <span class="badge-dot purple-dot"></span>
                        OUR COMPANY
                    </div>
                    <h2 class="section-title text-start about-company-title">Built on Manufacturing. Driven by Legacy.</h2>
                </div>
                <div class="about-company-copy">
                    <p>Since 1981, <strong>Ratnadeep Metal And Tubes Limited</strong> has built its reputation through disciplined manufacturing, dependable quality, and a commitment to continuous progress. Founded by <strong>Bharat S Sanghavi</strong> and led today by <strong>Jaimik B Sanghavi</strong>, the company continues to combine decades of expertise with modern manufacturing capabilities to serve industrial requirements across global markets.</p>
                    <p>Today, we manufacture <strong>seamless and welded pipes and tubes</strong> in stainless steel, carbon steel, alloy steel, nickel alloy, titanium, and low-fine tubes across a comprehensive range of sizes and specifications. Every product is supported by advanced manufacturing infrastructure, in-house inspection, and rigorous quality systems to ensure consistent performance and complete material traceability.</p>
                    <p class="mb-0">With a presence in over <strong>30 countries, Ratnadeep Metal And Tubes Limited</strong> supports leading engineering and industrial sectors through reliable manufacturing, timely delivery, and a customer-focused approach. The trust we have earned over four decades continues to be built on consistency, accountability, and long-term partnerships.</p>
                </div>
            </div>
            <div class="about-company-stats stats-grid">
                <div class="stat-item">
                    <h3 class="stat-number"><span class="counter-value" data-target="500">0</span>+</h3>
                    <p class="stat-label">Workforce Strength</p>
                </div>
                <div class="stat-item">
                    <h3 class="stat-number"><span class="counter-value" data-target="30">0</span>+</h3>
                    <p class="stat-label">Countries Served</p>
                </div>
                <div class="stat-item">
                    <h3 class="stat-number"><span class="counter-value" data-target="33">0</span>+ Million $</h3>
                    <p class="stat-label">Annual Revenue</p>
                </div>
                <div class="stat-item">
                    <h3 class="stat-number"><span class="counter-value" data-target="10000">0</span>+</h3>
                    <p class="stat-label">Annual Production <br> (Metric Tons)</p>
                </div>
                <div class="stat-item">
                    <h3 class="stat-number"><span class="counter-value" data-target="65000">0</span>+</h3>
                    <p class="stat-label">Total Facility Area <br> (Sq. Meters)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mt_80">
        <div class="container-fluid">
            <div class="text-center section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    PURPOSE &amp; DIRECTION
                </div>
                <h2 class="section-title">Building the Future Through Responsible Manufacturing.</h2>
            </div>
            <div class="about-mv-grid">
                <div class="about-mv-card">
                    <div class="about-mv-card-top">
                        <img src="assets/images/About/mission-icon.svg" alt="" class="about-mv-icon" width="80" height="80">
                        <div>
                            <h3 class="about-mv-heading">OUR MISSION</h3>
                            <p class="about-mv-text">To manufacture seamless and welded pipes and tubes through disciplined processes, advanced technology, and uncompromising quality standards, delivering reliable solutions that create lasting value for customers across global industries.</p>
                        </div>
                    </div>
                    <div class="about-mv-image">
                        <img src="assets/images/About/mission-image.png" alt="Ratnadeep manufacturing facility" class="img-fluid w-100">
                    </div>
                </div>
                <div class="about-mv-card">
                    <div class="about-mv-card-top">
                        <img src="assets/images/About/vision-icon.png" alt="" class="about-mv-icon" width="80" height="80">
                        <div>
                            <h3 class="about-mv-heading">Our Vision</h3>
                            <p class="about-mv-text">To be a globally trusted pipe and tube manufacturer, recognized for manufacturing excellence, continuous advancement, and a commitment to supporting industries with dependable products and responsible business practices.</p>
                        </div>
                    </div>
                    <div class="about-mv-image">
                        <img src="assets/images/About/vision-image.png" alt="Ratnadeep team at manufacturing site" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Stand For (reuse features-grid) -->
    <section class="mt_80">
        <div class="container">
            <div class="text-center section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    WHAT WE STAND FOR
                </div>
                <h2 class="section-title">The Standards Behind Every Product</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-number">01</div>
                    <div class="feature-content">
                        <h3 class="feature-title">Manufacturing Excellence</h3>
                        <p class="feature-desc">Every pipe and tube is manufactured through disciplined processes, advanced manufacturing infrastructure, and rigorous quality control to ensure consistent performance across industrial applications.</p>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-number">02</div>
                    <div class="feature-content">
                        <h3 class="feature-title">Customer Commitment</h3>
                        <p class="feature-desc">We support customers with reliable pipe and tube manufacturing solutions, responsive communication, dependable delivery, and a clear understanding of project requirements.</p>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-number">03</div>
                    <div class="feature-content">
                        <h3 class="feature-title">Continuous Improvement</h3>
                        <p class="feature-desc">We continuously strengthen our manufacturing capabilities, production technologies, and quality systems to meet evolving industry standards and customer expectations.</p>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="feature-number">04</div>
                    <div class="feature-content">
                        <h3 class="feature-title">Integrity in Operations</h3>
                        <p class="feature-desc">From raw material inspection to final dispatch, every pipe and tube is backed by complete material traceability, documented quality assurance, and transparent manufacturing practices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Strengths -->
    <section class="mt_80">
        <div class="container">
            <div class="text-center section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    OUR STRENGTHS
                </div>
                <h2 class="section-title">Built on Capability. Backed by Control.</h2>
            </div>
            <div class="about-strengths-grid">
                <div class="about-strength-card about-strength-card--sm">
                    <img src="assets/images/About/strength-1.png" alt="Complete Material Traceability">
                    <div class="about-strength-overlay"></div>
                    <div class="about-strength-content">
                        <h3 class="about-strength-title">Complete Material Traceability</h3>
                        <p class="about-strength-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="about-strength-card about-strength-card--lg">
                    <img src="assets/images/About/strength-2.png" alt="End-to-End In-House Manufacturing">
                    <div class="about-strength-overlay about-strength-overlay--gradient"></div>
                    <div class="about-strength-content">
                        <h3 class="about-strength-title">End-to-End In-House Manufacturing</h3>
                        <p class="about-strength-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                    </div>
                </div>
                <div class="about-strength-card about-strength-card--sm">
                    <img src="assets/images/About/strength-3.png" alt="Approved by Global Industries">
                    <div class="about-strength-overlay"></div>
                    <div class="about-strength-content">
                        <h3 class="about-strength-title">Approved by Global Industries</h3>
                        <p class="about-strength-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                    </div>
                </div>
                <div class="about-strength-card about-strength-card--sm">
                    <img src="assets/images/About/strength-4.png" alt="100% Inspection Before Dispatch">
                    <div class="about-strength-overlay"></div>
                    <div class="about-strength-content">
                        <h3 class="about-strength-title">100% Inspection Before Dispatch</h3>
                        <p class="about-strength-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership -->
    <section class="mt_100">
        <div class="container-fluid">
            <div class="text-center section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    OUR LEADERSHIP
                </div>
                <h2 class="section-title">Leading with Purpose. Building with Responsibility.</h2>
            </div>
            <div class="about-leadership-grid">
                <div class="about-leader-card">
                    <div class="about-leader-image-wrap about-leader-image-wrap--bharat" role="img" aria-label="Bharat S Sanghavi, Founder">
                        <div class="about-leader-media" aria-hidden="true">
                            <img src="assets/images/About/leader-bharat-bg.png" alt="" class="about-leader-layer about-leader-layer--bg">
                            <img src="assets/images/About/leader-bharat-fg.png" alt="" class="about-leader-layer about-leader-layer--fg">
                        </div>
                        <div class="about-leader-badge">
                            <strong>Bharat S Sanghavi</strong>
                            <span>Founder</span>
                        </div>
                    </div>
                    <blockquote class="about-leader-quote">"Our focus has always been to build products that customers can rely on, every time."</blockquote>
                    <p>Mr. Bharat S Sanghavi founded Ratnadeep Metal And Tubes Limited in 1981 with a clear vision to build a manufacturing company rooted in quality, discipline, and long-term trust. His commitment to precision, ethical business practices, and manufacturing excellence established the strong foundation on which the company continues to grow.</p>
                    <p class="mb-0">Today, his values remain embedded in every stage of manufacturing—from process control and quality assurance to customer relationships and operational discipline. This enduring philosophy continues to shape the culture and standards of the organisation.</p>
                </div>
                <div class="about-leader-card">
                    <div class="about-leader-image-wrap about-leader-image-wrap--jaimik" role="img" aria-label="Jaimik B Sanghavi, Director">
                        <div class="about-leader-media" aria-hidden="true">
                            <img src="assets/images/About/leader-jaimik-bg.png" alt="" class="about-leader-layer about-leader-layer--bg">
                            <img src="assets/images/About/leader-jaimik-fg.png" alt="" class="about-leader-layer about-leader-layer--fg">
                        </div>
                        <div class="about-leader-badge">
                            <strong>Jaimik B Sanghavi</strong>
                            <span>Director</span>
                        </div>
                    </div>
                    <blockquote class="about-leader-quote">"Growth is meaningful only when every product continues to reflect the same standards, quality and reliability."</blockquote>
                    <p>Under the leadership of Jaimik B Sanghavi, Ratnadeep Metal And Tubes Limited continues to expand its manufacturing capabilities while staying true to the principles established over four decades ago. His focus is on strengthening infrastructure, adopting advanced manufacturing practices, and enhancing operational efficiency to support evolving industrial requirements.</p>
                    <p class="mb-0">By combining experience with continuous improvement, he is guiding the company towards sustainable growth, global competitiveness, and long-term value creation for customers across diverse industries.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Global Network (reuse homepage section) -->
    <section class="mt_80 global-network-section">
        <div class="container">
            <div class="section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    A GLOBAL NETWORK OF EXCELLENCE.
                </div>
                <h2 class="section-title">Engineered in India. Trusted Worldwide.</h2>
            </div>
            <div class="map-container">
                <img src="assets/images/Map.webp" alt="Global Network Map" class="img-fluid map-image">
            </div>
            <div class="map-legend">
                <div class="legend-item">
                    <div class="legend-pill bg-light-purple">Customer Reach</div>
                    <div class="legend-icon" style="color: var(--icon-purple);">
                        <svg width="17" height="34" viewBox="0 0 17 34" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.50902 13.8198V27.5064C9.50902 29.477 8.98465 31.9087 8.47268 33.2859C8.39424 33.497 8.09641 33.497 8.01797 33.2859C7.506 31.9087 6.98163 29.477 6.98163 27.5064V13.8198H9.50902Z" fill="url(#about_paint0)"/><path d="M8.24545 16.4909C12.7993 16.4909 16.4909 12.7993 16.4909 8.24545C16.4909 3.69162 12.7993 0 8.24545 0C3.69161 0 0 3.69162 0 8.24545C0 12.7993 3.69161 16.4909 8.24545 16.4909Z" fill="#413185"/><path d="M8.21605 2.7858C8.35984 3.45262 7.96183 4.12201 7.30595 4.30946C6.49558 4.54106 5.75481 4.93266 5.04342 5.46785C4.04517 6.21918 3.26136 7.24783 2.78284 8.40155C2.70635 8.58592 2.52801 8.70752 2.3285 8.71378C2.03497 8.72299 1.79131 8.48325 1.80191 8.18975C1.86088 6.55967 2.50539 4.9532 3.60132 3.74354C4.42072 2.83902 5.40288 2.16341 6.51512 1.78844C7.25639 1.53852 8.04637 1.99486 8.21048 2.7597C8.21232 2.76841 8.2142 2.77709 8.21605 2.7858Z" fill="#BCADFE"/><defs><linearGradient id="about_paint0" x1="8.24532" y1="13.8198" x2="8.24532" y2="33.4442" gradientUnits="userSpaceOnUse"><stop stop-color="#533FA7"/><stop offset="1" stop-color="#080419"/></linearGradient></defs></svg>
                    </div>
                </div>
                <div class="legend-item">
                    <div class="legend-pill bg-light-red">Overseas Representative</div>
                    <div class="legend-icon" style="color: var(--primary-red);">
                        <svg width="18" height="35" viewBox="0 0 18 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.81147 14.2598V28.3821C9.81147 30.4155 9.27041 32.9246 8.74214 34.3457C8.6612 34.5634 8.35389 34.5634 8.27295 34.3457C7.74468 32.9246 7.20361 30.4155 7.20361 28.3821V14.2598H9.81147Z" fill="url(#about_paint1)"/><path d="M8.50798 17.016C13.2068 17.016 17.016 13.2068 17.016 8.50798C17.016 3.80915 13.2068 0 8.50798 0C3.80915 0 0 3.80915 0 8.50798C0 13.2068 3.80915 17.016 8.50798 17.016Z" fill="#E13324"/><path d="M8.47759 2.87492C8.62596 3.56297 8.21528 4.25367 7.53852 4.44709C6.70234 4.68606 5.93799 5.09013 5.20395 5.64237C4.17392 6.41761 3.36515 7.47902 2.87139 8.66946C2.79247 8.85971 2.60845 8.98518 2.40259 8.99164C2.09971 9.00115 1.8483 8.75377 1.85923 8.45093C1.92008 6.76894 2.58511 5.11132 3.71593 3.86316C4.56142 2.92983 5.57485 2.23271 6.72251 1.8458C7.48738 1.58793 8.30252 2.05879 8.47184 2.84798C8.47375 2.85698 8.47569 2.86593 8.47759 2.87492Z" fill="#F96F5D"/><defs><linearGradient id="about_paint1" x1="8.50754" y1="14.2598" x2="8.50754" y2="34.509" gradientUnits="userSpaceOnUse"><stop stop-color="#E23737"/><stop offset="1" stop-color="#7C1E1E"/></linearGradient></defs></svg>
                    </div>
                </div>
                <div class="legend-item">
                    <div class="legend-pill bg-light-purple">Manufacturing Site</div>
                    <div class="legend-icon">
                        <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.7646 0.5C33.5068 0.5 43.0291 10.008 43.0293 21.7539C43.0293 33.5005 33.5063 43.0273 21.7646 43.0273C10.0234 43.0273 0.5 33.4818 0.5 21.7539C0.500168 10.0267 10.0229 0.500091 21.7646 0.5Z" fill="white" stroke="#DDDDDD"/><path fill-rule="evenodd" clip-rule="evenodd" d="M37.4193 14.0862C37.4193 19.8987 32.9718 24.1776 26.8019 24.1776C26.4423 24.1776 26.3855 24.1776 25.4581 24.1208C27.275 25.4083 28.6756 25.8816 30.7385 25.8816C31.1549 25.8816 31.6091 25.8248 32.1958 25.768C32.3661 25.7112 32.5554 25.7112 32.669 25.7112C33.3124 25.7112 33.8991 26.2413 33.8991 26.8283C33.8991 27.0555 33.8424 27.3016 33.672 27.8885C33.4449 28.5322 33.3881 28.7026 33.3881 29.0624C33.3881 29.4789 33.5584 30.0658 33.918 30.8232L35.8485 34.9885C36.0378 35.405 36.2648 35.7458 36.473 36.1055C40.1068 32.4514 42.359 27.4152 42.359 21.8488C42.359 12.9692 36.6244 5.45267 28.6756 2.76416C33.9748 4.63855 37.4193 8.82279 37.4193 14.1052" fill="#E13324"/><path fill-rule="evenodd" clip-rule="evenodd" d="M25.2688 40.3656C25.2688 39.8355 25.4959 39.5515 26.2151 39.2485C27.2749 38.7752 27.6723 38.2451 27.6723 37.4878C27.6723 35.5566 24.9848 30.3878 21.9946 26.5254C18.9475 22.5305 18.0012 20.5426 18.0012 18.0812C18.0012 14.5597 20.5183 11.6818 23.5086 11.6818C25.7986 11.6818 27.6156 13.329 27.6156 15.2602C27.6156 16.737 26.6125 17.8351 25.2688 17.8351C24.6253 17.8351 24.1521 17.4754 24.1521 16.8884C24.1521 16.5855 24.2657 16.4151 24.6253 16.1879C24.9849 15.9039 25.0984 15.6578 25.0984 15.3738C25.0984 14.7301 24.3981 14.1999 23.6222 14.1999C22.2216 14.1999 21.0483 15.4306 21.0483 16.9642C21.0483 19.009 22.8084 20.4857 25.212 20.4857C28.3158 20.4857 30.7762 18.0244 30.7762 14.8058C30.7762 11.2842 27.8995 8.5957 24.1521 8.5957H6.96736C3.86351 12.1362 1.97095 16.7749 1.97095 21.8679C1.97095 33.0195 10.9986 42.0506 22.1459 42.0506C23.6222 42.0506 25.0606 41.8802 26.4422 41.5773C25.6094 41.4637 25.2498 41.1229 25.2498 40.3845" fill="#413185"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Six Stages -->
    <section class="mt_80">
        <div class="container-fluid">
            <div class="about-stages-grid">
                <div class="about-stages-media">
                    <img src="assets/images/About/stages-manufacturing.png" alt="Ratnadeep pipe and tube manufacturing" class="about-stages-image">
                </div>
                <div class="about-stages-content">
                    <div class="about-stages-intro">
                        <div class="section-badge align-left">
                            <span class="badge-dot purple-dot"></span>
                            HOW WE MANUFACTURE
                        </div>
                        <h2 class="section-title text-start about-stages-title">Six Stages. One Standard.</h2>
                    </div>
                    <div class="about-stages-panel">
                        <h3 class="about-stages-heading" id="aboutStageTitle">Raw Material Inspection</h3>
                        <p class="about-stages-text" id="aboutStageText">Every raw material batch is carefully inspected for chemical composition, mechanical properties, and dimensional accuracy before entering production, ensuring every pipe and tube begins with verified quality.</p>
                    </div>
                    <div class="about-stages-indicators" id="aboutStagesIndicators" role="tablist" aria-label="Manufacturing stages">
                        <button type="button" class="about-stages-indicator active" role="tab" aria-selected="true" aria-controls="aboutStageTitle" data-index="0" aria-label="Stage 1: Raw Material Inspection"></button>
                        <button type="button" class="about-stages-indicator" role="tab" aria-selected="false" aria-controls="aboutStageTitle" data-index="1" aria-label="Stage 2: Pipe Forming &amp; Rolling"></button>
                        <button type="button" class="about-stages-indicator" role="tab" aria-selected="false" aria-controls="aboutStageTitle" data-index="2" aria-label="Stage 3: Heat Treatment"></button>
                        <button type="button" class="about-stages-indicator" role="tab" aria-selected="false" aria-controls="aboutStageTitle" data-index="3" aria-label="Stage 4: In-House Testing &amp; NDT"></button>
                        <button type="button" class="about-stages-indicator" role="tab" aria-selected="false" aria-controls="aboutStageTitle" data-index="4" aria-label="Stage 5: Finishing &amp; Marking"></button>
                        <button type="button" class="about-stages-indicator" role="tab" aria-selected="false" aria-controls="aboutStageTitle" data-index="5" aria-label="Stage 6: Final Inspection &amp; Dispatch"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Careers -->
    <section class="mt_80 about-careers-section">
        <div class="container">
            <div class="text-center section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    Careers at Ratnadeep
                </div>
                <h2 class="section-title">Careers at Ratnadeep</h2>
                <p class="about-careers-lead">Bring your expertise to a team driven by engineering precision, manufacturing discipline, and continuous improvement.</p>
                <a href="#contact" class="com_btn_red">Join Our Team <span class="ms-2"><?php echo $arrow_icon; ?></span></a>
            </div>
            <div class="about-careers-gallery">
                <div class="about-career-card about-career-card--left">
                    <img src="assets/images/About/career-1.png" alt="Ratnadeep team meeting" class="img-fluid w-100">
                </div>
                <div class="about-career-card about-career-card--center">
                    <img src="assets/images/About/career-2.png" alt="" class="about-career-layer about-career-layer--bg" aria-hidden="true">
                    <img src="assets/images/About/career-2-overlay.png" alt="Ratnadeep workforce at manufacturing facility" class="about-career-layer about-career-layer--fg">
                </div>
                <div class="about-career-card about-career-card--right">
                    <img src="assets/images/About/career-3.png" alt="Ratnadeep team collaboration" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </section>

    <!-- Certified for Global Standards -->
    <section class="mt_80 about-certifications-section">
        <div class="container">
            <div class="text-center section-header-gap">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    QUALITY SYSTEMS
                </div>
                <h2 class="section-title">Certified for Global Standards</h2>
            </div>
            <div class="about-cert-grid">
                <div class="about-cert-card">
                    <img src="assets/images/About/cert-iso9001.png" alt="ISO 9001:2015 certification">
                    <p>ISO 9001: 2015</p>
                </div>
                <div class="about-cert-card">
                    <img src="assets/images/About/cert-iso45001.png" alt="ISO 45001:2018 certification">
                    <p>ISO 45001: 2018</p>
                </div>
                <div class="about-cert-card">
                    <img src="assets/images/About/cert-ped-adwo.png" alt="PED and ADWO certification">
                    <p>PED &amp; ADWO</p>
                </div>
                <div class="about-cert-card">
                    <img src="assets/images/About/cert-iso14001.png" alt="ISO 14001:2015 certification">
                    <p>ISO 14001: 2015</p>
                </div>
                <div class="about-cert-card about-cert-card--wide-sm">
                    <img src="assets/images/About/cert-norsok.png" alt="NORSOK certification">
                    <p>NORSOK</p>
                </div>
                <div class="about-cert-card about-cert-card--wide-sm">
                    <img src="assets/images/About/cert-marine.png" alt="Marine certification">
                    <p>Marine</p>
                </div>
                <div class="about-cert-card about-cert-card--wide-lg">
                    <img src="assets/images/About/cert-cbb.png" alt="Central Boilers Board certification">
                    <p>"Well Known Pipe/Tube Maker" by Central Boilers Board, India</p>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var stages = [
        {
            title: 'Raw Material Inspection',
            text: 'Every raw material batch is carefully inspected for chemical composition, mechanical properties, and dimensional accuracy before entering production, ensuring every pipe and tube begins with verified quality.'
        },
        {
            title: 'Pipe Forming & Rolling',
            text: 'Seamless and welded pipes and tubes are formed through controlled rolling, piercing, and welding processes managed in-house to maintain tighter tolerances, consistent dimensions, and reliable mechanical performance.'
        },
        {
            title: 'Heat Treatment',
            text: 'Heat treatment is carried out under controlled furnace conditions to achieve the required metallurgical structure, strength, and durability needed for demanding industrial and high-pressure applications.'
        },
        {
            title: 'In-House Testing & NDT',
            text: 'Every product undergoes rigorous in-house inspection and non-destructive testing, including dimensional verification and material validation, to confirm compliance with applicable standards before moving to finishing.'
        },
        {
            title: 'Finishing & Marking',
            text: 'Pipes and tubes are finished, marked, and documented with complete material traceability so every product can be identified, tracked, and supplied with the quality records required by global customers.'
        },
        {
            title: 'Final Inspection & Dispatch',
            text: 'Before dispatch, every order passes through final inspection and packing checks to ensure products leave our facility ready for dependable performance in domestic and international project environments.'
        }
    ];

    var titleEl = document.getElementById('aboutStageTitle');
    var textEl = document.getElementById('aboutStageText');
    var indicatorsWrap = document.getElementById('aboutStagesIndicators');

    if (!titleEl || !textEl || !indicatorsWrap) {
        return;
    }

    // Add CSS transitions for smooth fade effect
    titleEl.style.transition = 'opacity 0.4s ease-in-out';
    textEl.style.transition = 'opacity 0.4s ease-in-out';

    var indicators = indicatorsWrap.querySelectorAll('.about-stages-indicator');
    var activeIndex = 0;
    var timer;
    var isAnimating = false;

    function setStage(index, initial = false) {
        if (activeIndex === index && !initial) return;
        if (isAnimating) return;
        
        activeIndex = index;
        var stage = stages[index];

        if (initial) {
            titleEl.textContent = stage.title;
            textEl.textContent = stage.text;
        } else {
            isAnimating = true;
            titleEl.style.opacity = 0;
            textEl.style.opacity = 0;

            setTimeout(function() {
                titleEl.textContent = stage.title;
                textEl.textContent = stage.text;
                
                titleEl.style.opacity = 1;
                textEl.style.opacity = 1;
                
                setTimeout(function() {
                    isAnimating = false;
                }, 400);
            }, 400);
        }

        indicators.forEach(function (indicator, i) {
            var isActive = i === index;
            indicator.classList.toggle('active', isActive);
            indicator.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    }

    indicators.forEach(function (indicator) {
        indicator.addEventListener('click', function () {
            if (isAnimating || activeIndex === Number(indicator.getAttribute('data-index'))) return;
            clearInterval(timer);
            setStage(Number(indicator.getAttribute('data-index')));
            startAutoPlay();
        });
    });

    function startAutoPlay() {
        clearInterval(timer);
        timer = setInterval(function () {
            if (!isAnimating) {
                setStage((activeIndex + 1) % stages.length);
            }
        }, 5000);
    }

    setStage(0, true);
    startAutoPlay();
});
</script>

<?php include 'includes/footer.php'; ?>
