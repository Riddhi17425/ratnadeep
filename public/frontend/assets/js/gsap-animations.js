document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    // --- SETUP LENIS SMOOTH SCROLLING ---
    const lenis = new Lenis({
        prevent: (node) => {
            // Allow native mouse wheel scrolling inside the Select2 dropdowns
            return node.closest && node.closest('.select2-results__options, .select2-container');
        }
    });

    lenis.on('scroll', ScrollTrigger.update);
    ScrollTrigger.addEventListener('refresh', () => lenis.resize());

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);

    // Keep Lenis scroll limit accurate when images, fonts, sliders, or DOM height changes
    if (window.ResizeObserver) {
        new ResizeObserver(() => {
            lenis.resize();
        }).observe(document.body);
    }

    window.addEventListener('load', () => {
        ScrollTrigger.refresh();
        lenis.resize();
    });
    // --- END LENIS SETUP ---

    const loader = document.getElementById("gsap-loader");
    if (!loader) return;

    // Scrolling remains active so scrollbar stays visible

    // Elements
    const header = document.querySelector(".header");
    const paths = document.querySelectorAll("#loader-inline-logo path");
    const logoWrap = document.getElementById("loader-logo-wrap");

    // Homepage hero elements (index slider only)
    const homeHeroSection = document.querySelector('.hero-section');
    const heroBadges = homeHeroSection ? homeHeroSection.querySelectorAll('.hero-badge') : [];
    const heroTitles = homeHeroSection ? homeHeroSection.querySelectorAll('.hero-title') : [];
    const heroSubtitles = homeHeroSection ? homeHeroSection.querySelectorAll('.hero-subtitle') : [];
    const heroButtons = homeHeroSection ? homeHeroSection.querySelectorAll('.hero-buttons a') : [];
    const heroBgs = homeHeroSection ? homeHeroSection.querySelectorAll('.slick-slide-item') : [];
    const productTabs = homeHeroSection ? homeHeroSection.querySelectorAll('.hero-product-tabs .tab-item') : [];

    // Inner page heroes — simple stagger reveal (CSS), not word-split cinematic
    const innerHeroSections = document.querySelectorAll('.inner-hero-section');

    // Custom Awwwards-style Word Splitter
    function premiumTextSplit(elements) {
        let elementsArr = [];
        elements.forEach(el => {
            const html = el.innerHTML;
            el.innerHTML = "";
            const tokens = html.split(/(<br\s*\/?>|\s+)/i);
            tokens.forEach(token => {
                if (!token || (token.trim() === "" && !token.match(/<br/i))) {
                    if (token === " ") el.appendChild(document.createTextNode(" "));
                    return;
                }
                if (token.match(/<br/i)) {
                    el.appendChild(document.createElement("br"));
                    return;
                }
                const wrapper = document.createElement("span");
                wrapper.style.display = "inline-block";
                wrapper.style.overflow = "hidden";
                wrapper.style.verticalAlign = "top";

                const inner = document.createElement("span");
                inner.style.display = "inline-block";
                inner.style.transformOrigin = "left bottom";
                inner.innerHTML = token;

                wrapper.appendChild(inner);
                el.appendChild(wrapper);
                if (!token.match(/<br/i)) el.appendChild(document.createTextNode(" "));
                elementsArr.push(inner);
            });
        });
        return elementsArr;
    }

    const titleWords = premiumTextSplit(heroTitles);
    const subtitleWords = premiumTextSplit(heroSubtitles);

    // Check if desktop for specific animations
    const isDesktopLoader = window.innerWidth > 991;

    // Initial States
    if (header && isDesktopLoader) {
        gsap.set(header, { y: "-100%", opacity: 0 });
    } else if (header) {
        gsap.set(header, { opacity: 0 }); // Just fade on mobile
    }
    gsap.set(heroBgs, { scale: 1.15 });
    gsap.set(heroBadges, { opacity: 0, x: -30 });
    gsap.set([titleWords, subtitleWords], { y: "150%", rotationZ: 8, opacity: 0 });
    gsap.set(heroButtons, { opacity: 0, y: 30, scale: 0.9 });
    gsap.set(productTabs, { opacity: 0, y: 40 });
    const tabsContainer = document.querySelector('.hero-product-tabs');
    const slickSliderEl = document.querySelector('.hero-slick-slider');

    // Lock interactions and pause slick autoplay during the initial load animation
    if (tabsContainer) tabsContainer.style.pointerEvents = "none";
    if (slickSliderEl) slickSliderEl.style.pointerEvents = "none";

    if (window.jQuery) {
        // Small timeout to ensure Slick has finished initializing
        setTimeout(() => {
            const $slider = $('.hero-slick-slider');
            if ($slider.length && $slider.hasClass('slick-initialized')) {
                $slider.slick('slickPause');
            }
        }, 150);
    }

    const tl = gsap.timeline({
        onComplete: () => {
            // Unlock interactions and resume slick autoplay
            if (tabsContainer) tabsContainer.style.pointerEvents = "auto";
            if (slickSliderEl) slickSliderEl.style.pointerEvents = "auto";
            if (window.jQuery) {
                const $slider = $('.hero-slick-slider');
                if ($slider.length && $slider.hasClass('slick-initialized')) {
                    $slider.slick('slickPlay');
                }
            }
            ScrollTrigger.refresh();
        }
    });

    const isLoaderSkipped = document.documentElement.classList.contains('loader-skipped') || sessionStorage.getItem('loaderShown');

    if (!isLoaderSkipped) {
        sessionStorage.setItem('loaderShown', 'true');
        // --- SETUP SVG DRAWING EFFECT ---
        paths.forEach(path => {
            const fill = path.getAttribute("fill");
            // Only target paths that have an actual color fill
            if (fill && fill !== "none" && fill !== "transparent") {
                // Save original fill
                path.dataset.fill = fill;

                // Set up stroke for drawing
                path.setAttribute("stroke", fill);
                path.setAttribute("stroke-width", "0.75");
                path.setAttribute("fill", "transparent");

                try {
                    // Get exact path length for perfect drawing
                    const length = path.getTotalLength() + 5;
                    path.style.strokeDasharray = length;
                    path.style.strokeDashoffset = length;
                } catch (e) {
                    // Safe fallback for complex paths
                    path.style.strokeDasharray = 2000;
                    path.style.strokeDashoffset = 2000;
                }
            }
        });

        // --- ANIMATION SEQUENCE ---

        // 1. Draw the SVG paths smoothly
        tl.to(paths, {
            strokeDashoffset: 0,
            duration: 2.5,
            ease: "power2.inOut",
            stagger: 0.02
        });

        // 2. Fill the logo with its original colors seamlessly
        tl.to(paths, {
            fill: (i, target) => target.dataset.fill,
            duration: 1,
            ease: "power2.out"
        }, "-=1.0");

        // 3. Fade out the stroke to leave just the clean logo
        tl.to(paths, {
            stroke: "transparent",
            duration: 0.8
        }, "-=1.0");

        // 4. Subtle pop of the logo before exit
        tl.to(logoWrap, {
            scale: 1.05,
            duration: 0.8,
            ease: "power2.out"
        }, "-=0.8");

        // 5. Fade out the glassmorphism loader revealing the site behind it
        tl.to(loader, {
            opacity: 0,
            duration: 1.2,
            ease: "power2.inOut"
        });

        // IMMEDIATELY remove loader from DOM to unlock scrolling and clicking!
        tl.set(loader, { pointerEvents: "none", display: "none" });

        // Mark loader as shown for next time
        sessionStorage.setItem('loaderShown', 'true');
    } else {
        // Loader is skipped, just ensure it's hidden in GSAP too
        gsap.set(loader, { pointerEvents: "none", display: "none", opacity: 0 });
    }

    // 6. Header drops in
    if (header && isDesktopLoader) {
        tl.to(header, {
            y: "0%",
            opacity: 1,
            duration: 1.2,
            ease: "power3.out",
            clearProps: "transform"
        }, "-=0.8");
    } else if (header) {
        tl.to(header, {
            opacity: 1,
            duration: 1.2
        }, "-=0.8");
    }

    // 7. Awwwards Premium Cinematic Reveal — Homepage
    if (heroBgs.length) {
        tl.to(heroBgs, { scale: 1, duration: isLoaderSkipped ? 1.5 : 3, ease: "power2.out" }, isLoaderSkipped ? "-=0.4" : "-=1.0");
    }
    if (heroBadges.length) {
        tl.to(heroBadges, { x: 0, opacity: 1, duration: 0.8, ease: "power3.out" }, isLoaderSkipped ? "-=1.2" : (heroBgs.length ? "-=2.5" : "-=1.0"));
    }
    if (titleWords.length) {
        tl.to(titleWords, {
            y: "0%", rotationZ: 0, opacity: 1, duration: 0.9, stagger: 0.03, ease: "power4.out"
        }, isLoaderSkipped ? "-=1.0" : (heroBgs.length ? "-=2.3" : "-=1.0"));
    }
    if (subtitleWords.length) {
        tl.to(subtitleWords, {
            y: "0%", rotationZ: 0, opacity: 1, duration: 0.8, stagger: 0.015, ease: "power3.out"
        }, isLoaderSkipped ? "-=0.8" : (heroBgs.length ? "-=1.8" : "-=0.8"));
    }
    if (heroButtons.length) {
        tl.to(heroButtons, {
            y: 0, opacity: 1, scale: 1, duration: 0.7, stagger: 0.1, ease: "power3.out"
        }, isLoaderSkipped ? "-=0.7" : (heroBgs.length ? "-=1.5" : "-=0.6"));
    }
    if (productTabs.length) {
        tl.to(productTabs, {
            y: 0, opacity: 1, duration: 0.7, stagger: 0.05, ease: "power3.out"
        }, isLoaderSkipped ? "-=0.7" : (heroBgs.length ? "-=1.4" : "-=0.5"));
    }

    if (innerHeroSections.length) {
        if (isLoaderSkipped) {
            // Add immediately to prevent invisible text when loader is skipped
            innerHeroSections.forEach((section) => section.classList.add("is-hero-ready"));
        } else {
            tl.call(() => {
                innerHeroSections.forEach((section) => section.classList.add("is-hero-ready"));
            }, null, "-=0.6");
        }
    }

    // --- Subtle Hover Interactions ---
    const buttons = document.querySelectorAll('.com_btn_red, .com_btn_outline_white');
    buttons.forEach(btn => {
        btn.addEventListener("mouseenter", () => {
            gsap.to(btn, { scale: 1.05, duration: 0.3, ease: "power2.out" });
        });
        btn.addEventListener("mouseleave", () => {
            gsap.to(btn, { scale: 1, duration: 0.3, ease: "power2.out" });
        });
    });

    // --- Tab Click & Slide Change Animations ---
    if (window.jQuery) {
        // 1. Tactile bounce animation on tab click
        $('.hero-product-tabs .tab-item').on('click', function () {
            gsap.fromTo(this, { scale: 0.85, color: "#fff" }, { scale: 1, color: "", duration: 0.6, ease: "elastic.out(1, 0.4)" });
        });

        // 2. Re-trigger the premium text reveal for the incoming slide
        $('.hero-slick-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            if (currentSlide === nextSlide) return;

            // Get elements of the next slide
            const nextSlideEl = slick.$slides.get(nextSlide);
            const nextTitles = nextSlideEl.querySelectorAll('.hero-title span > span');
            const nextSubtitles = nextSlideEl.querySelectorAll('.hero-subtitle span > span');
            const nextButtons = nextSlideEl.querySelectorAll('.hero-buttons a');

            // Reset them instantly to hidden state
            gsap.set([nextTitles, nextSubtitles], { y: "150%", rotationZ: 8, opacity: 0 });
            gsap.set(nextButtons, { opacity: 0, y: 30, scale: 0.9 });

            // Array of completely different premium effects for each slide
            const effects = [
                // 0: Expanding Circle from Center
                {
                    start: { clipPath: "circle(0% at 50% 50%)", backgroundPosition: "50% 100%" },
                    end: { clipPath: "circle(150% at 50% 50%)", backgroundPosition: "50% 50%", duration: 2, ease: "expo.inOut" }
                },
                // 1: Center Split (Curtain Open)
                {
                    start: { clipPath: "polygon(50% 0%, 50% 0%, 50% 100%, 50% 100%)", backgroundPosition: "50% 0%" },
                    end: { clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)", backgroundPosition: "50% 50%", duration: 1.8, ease: "power4.inOut" }
                },
                // 2: Sweep from Left Edge
                {
                    start: { clipPath: "inset(0% 100% 0% 0%)", backgroundPosition: "100% 50%" },
                    end: { clipPath: "inset(0% 0% 0% 0%)", backgroundPosition: "50% 50%", duration: 1.8, ease: "power4.inOut" }
                },
                // 3: Diagonal Expand from Top Right Corner
                {
                    start: { clipPath: "circle(0% at 100% 0%)", backgroundPosition: "0% 100%" },
                    end: { clipPath: "circle(200% at 100% 0%)", backgroundPosition: "50% 50%", duration: 2, ease: "expo.inOut" }
                },
                // 4: Sweep Up from Bottom
                {
                    start: { clipPath: "inset(100% 0% 0% 0%)", backgroundPosition: "50% 0%" },
                    end: { clipPath: "inset(0% 0% 0% 0%)", backgroundPosition: "50% 50%", duration: 1.8, ease: "power4.inOut" }
                }
            ];

            // Select effect based on the incoming slide index (loops if more slides than effects)
            const activeEffect = effects[nextSlide % effects.length];

            // Apply the chosen dynamic Image wipe + pan effect
            gsap.fromTo(nextSlideEl, activeEffect.start, activeEffect.end);

            // Animate the text in slightly after the image wipe starts
            const slideTl = gsap.timeline({ delay: 0.2 });
            if (nextTitles.length) slideTl.to(nextTitles, { y: "0%", rotationZ: 0, opacity: 1, duration: 0.8, stagger: 0.03, ease: "power4.out" }, 0);
            if (nextSubtitles.length) slideTl.to(nextSubtitles, { y: "0%", rotationZ: 0, opacity: 1, duration: 0.7, stagger: 0.015, ease: "power3.out" }, 0.08);
            if (nextButtons.length) slideTl.to(nextButtons, { y: 0, opacity: 1, scale: 1, duration: 0.6, stagger: 0.08, ease: "power3.out" }, 0.15);
        });
    }

    // ==========================================
    // PINNED SCRUB REVEAL (Industries Section)
    // ==========================================
    const industriesGrid = document.querySelector('.industries-grid');
    if (industriesGrid) {
        const industriesSection = industriesGrid.closest('section');
        gsap.set(industriesGrid, { perspective: 1500 });
        const industryCards = industriesGrid.querySelectorAll('.industry-card');

        // Initial hidden state (positioned far below for a dramatic upward slide)
        gsap.set(industryCards, {
            y: 450,
            opacity: 0,
            scale: 1,
            rotationX: 0
        });

        ScrollTrigger.matchMedia({
            // Desktop: Pinned scrub sequence
            "(min-width: 992px)": function () {
                // First card animates independently WHILE the header is scrolling up
                gsap.to(industryCards[0], {
                    scrollTrigger: {
                        trigger: industriesSection,
                        start: "top 80%", // Starts coming up as soon as section appears
                        end: "top 10%",   // Finishes exactly when the section pins
                        scrub: 1
                    },
                    y: 0,
                    opacity: 1,
                    scale: 1,
                    rotationX: 0
                });

                const animatedCards = Array.from(industryCards).slice(1); // Cards 2, 3, 4

                const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: industriesSection,
                        start: "top 10%", // Pin starts here
                        end: "+=1000",
                        pin: true,
                        scrub: 1
                    }
                });

                // Add remaining cards to the timeline sequentially
                animatedCards.forEach((card) => {
                    tl.to(card, {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        rotationX: 0,
                        duration: 1,
                        ease: "power2.out"
                    });
                });
            },

            // Mobile: Standard stagger reveal (no pinning to keep mobile UX smooth)
            "(max-width: 991px)": function () {
                gsap.to(industryCards, {
                    scrollTrigger: {
                        trigger: industriesGrid,
                        start: "top 85%",
                        once: true
                    },
                    y: 0,
                    opacity: 1,
                    scale: 1,
                    rotationX: 0,
                    duration: 1.2,
                    stagger: 0.2,
                    ease: "expo.out"
                });
            }
        });
    }

    // ==========================================
    // PREMIUM 3D SCROLL REVEAL (Products Section Only)
    // ==========================================
    const productsGrid = document.querySelector('.products-grid');
    if (productsGrid) {
        // Set 3D perspective on the parent for depth
        gsap.set(productsGrid, { perspective: 1500 });

        const productCards = productsGrid.querySelectorAll('.product-card');

        // Initial hidden 3D state before scroll
        gsap.set(productCards, {
            y: 120,
            opacity: 0,
            scale: 0.85,
            rotationX: 30,
            transformOrigin: "50% 100%"
        });

        // Trigger staggered reveal when scrolling into view
        ScrollTrigger.batch(productCards, {
            start: "top 85%",
            onEnter: batch => {
                gsap.to(batch, {
                    y: 0,
                    opacity: 1,
                    scale: 1,
                    rotationX: 0,
                    duration: 1.4,
                    stagger: 0.15,
                    ease: "expo.out",
                    overwrite: true
                });
            }
        });
    }

    // ==========================================
    // EVENTS SECTION (Reference Animation)
    // ==========================================
    const videoThumbnail = document.querySelector('.video-thumbnail');
    if (videoThumbnail) {
        const eventsSection = videoThumbnail.closest('section');
        const badge = eventsSection.querySelector('.section-badge');
        const heading = eventsSection.querySelector('.section-title');

        // Prepare text splitting for the heading without modifying HTML file
        if (heading && !heading.classList.contains('split-done')) {
            const text = heading.textContent;
            heading.innerHTML = text.split(" ").map(w => `<span class='event-word' style='display:inline-block; opacity:0; transform:translateY(60px); filter:blur(10px);'>${w}&nbsp;</span>`).join("");
            heading.classList.add('split-done');
        }

        const eventsTl = gsap.timeline({
            scrollTrigger: {
                trigger: eventsSection,
                start: "top 75%",
                once: true
            }
        });

        // 1. Video mask reveal (simulated using clipPath)
        const videoImg = videoThumbnail.querySelector('img');
        if (videoImg) gsap.set(videoImg, { scale: 1.2 });

        eventsTl.from(videoThumbnail, { clipPath: "inset(0 100% 0 0)", duration: 1.1, ease: "power3.inOut" })
            .to(videoImg, { scale: 1, duration: 1.3 }, "<");

        // 2. Badge smooth reveal
        if (badge) {
            eventsTl.from(badge, { y: 20, opacity: 0, filter: "blur(5px)", duration: 0.8, ease: "power2.out" }, "-=0.5");
        }

        // 3. Heading words reveal (smooth fade)
        eventsTl.to('.event-word', { opacity: 1, y: 0, filter: "blur(0px)", stagger: 0.04, duration: 0.8, ease: "power3.out" }, "-=0.4");

        // 4. Stagger the event slide items smoothly
        const eventSlides = eventsSection.querySelectorAll('.event-slide-item');
        if (eventSlides.length > 0) {
            eventsTl.from(eventsSection.querySelectorAll('.event-logo'), { y: 20, opacity: 0, duration: 0.8, stagger: 0.1, ease: "power2.out" }, "-=0.4")
                .from(eventsSection.querySelectorAll('.event-name'), { y: 15, opacity: 0, duration: 0.8, stagger: 0.1, ease: "power2.out" }, "-=0.6")
                .from(eventsSection.querySelectorAll('.event-date'), { y: 15, opacity: 0, duration: 0.8, stagger: 0.1, ease: "power2.out" }, "-=0.6")
                .from(eventsSection.querySelectorAll('.event-contact'), { y: 15, opacity: 0, duration: 0.8, stagger: 0.1, ease: "power2.out" }, "-=0.6");
        }

        // 3D Hover effect on video exactly as referenced
        videoThumbnail.addEventListener("mousemove", e => {
            const r = videoThumbnail.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width - 0.5;
            const y = (e.clientY - r.top) / r.height - 0.5;
            gsap.to(videoThumbnail, { rotationY: x * 6, rotationX: -y * 6, duration: 0.3, transformPerspective: 1000, transformOrigin: "center center" });
        });
        videoThumbnail.addEventListener("mouseleave", () => {
            gsap.to(videoThumbnail, { rotationX: 0, rotationY: 0, duration: 0.4 });
        });
    }

    // ==========================================
    // BLOGS SECTION (Normal Fade In)
    // ==========================================
    const blogsSection = document.querySelector('.blogs-section');
    if (blogsSection) {
        const blogCards = blogsSection.querySelectorAll('.blog-card');
        const blogHeader = blogsSection.querySelector('.section-header-gap');

        // Combine header and cards to animate them together
        const elementsToAnimate = [blogHeader, ...blogCards];

        // Very noticeable, punchy fade in so you can definitely feel the animation
        gsap.from(elementsToAnimate, {
            scrollTrigger: {
                trigger: blogsSection,
                start: "top 75%", // Wait until it's more visible on screen
                once: true
            },
            y: 80, // Much larger slide distance
            opacity: 0,
            scale: 0.95, // Slight pop-in effect
            duration: 1.2,
            stagger: 0.2, // Distinct delay between each card
            ease: "back.out(1.4)" // Satisfying snap into place
        });
    }

    // ==========================================
    // ABOUT PAGE SCROLL ANIMATIONS
    // ==========================================
    const aboutPage = document.querySelector('.page-about');
    if (aboutPage) {
        const companySection = aboutPage.querySelector('#manufacturing');
        if (companySection) {
            const companyItems = companySection.querySelectorAll('.about-company-intro, .about-company-copy');
            gsap.from(companyItems, {
                scrollTrigger: {
                    trigger: companySection,
                    start: "top 75%",
                    once: true
                },
                y: 80,
                opacity: 0,
                duration: 1.2,
                stagger: 0.15,
                ease: "back.out(1.4)"
            });
        }

        const aboutMvGrid = aboutPage.querySelector('.about-mv-grid');
        if (aboutMvGrid) {
            const mvSection = aboutMvGrid.closest('section');
            const mvHeader = mvSection ? mvSection.querySelector('.section-header-gap') : null;
            const mvCards = aboutMvGrid.querySelectorAll('.about-mv-card');

            gsap.set(aboutMvGrid, { perspective: 1500 });
            gsap.set(mvCards, {
                y: 120,
                opacity: 0,
                scale: 0.85,
                rotationX: 30,
                transformOrigin: "50% 100%"
            });

            if (mvHeader) {
                gsap.from(mvHeader, {
                    scrollTrigger: {
                        trigger: mvSection,
                        start: "top 75%",
                        once: true
                    },
                    y: 80,
                    opacity: 0,
                    scale: 0.95,
                    duration: 1.2,
                    ease: "back.out(1.4)"
                });
            }

            ScrollTrigger.batch(mvCards, {
                start: "top 85%",
                onEnter: batch => {
                    gsap.to(batch, {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        rotationX: 0,
                        duration: 1.4,
                        stagger: 0.15,
                        ease: "expo.out",
                        overwrite: true
                    });
                }
            });
        }

        const aboutFeaturesGrid = aboutPage.querySelector('.features-grid');
        if (aboutFeaturesGrid) {
            const aboutFeaturesSection = aboutFeaturesGrid.closest('section');
            const featuresHeader = aboutFeaturesSection ? aboutFeaturesSection.querySelector('.section-header-gap') : null;
            const featuresBadge = featuresHeader ? featuresHeader.querySelector('.section-badge') : null;
            const featuresHeading = aboutFeaturesSection ? aboutFeaturesSection.querySelector('.section-title') : null;
            const aboutFeatureCards = aboutFeaturesGrid.querySelectorAll('.feature-card');

            if (featuresHeading && !featuresHeading.classList.contains('split-done')) {
                const featuresTitleText = featuresHeading.textContent;
                featuresHeading.innerHTML = featuresTitleText.split(" ").map(w => `<span class='about-features-word' style='display:inline-block; opacity:0; transform:translateY(40px); filter:blur(6px);'>${w}&nbsp;</span>`).join("");
                featuresHeading.classList.add('split-done');
            }

            if (featuresBadge) gsap.set(featuresBadge, { y: 18, opacity: 0 });
            aboutFeatureCards.forEach((card, i) => {
                gsap.set(card, {
                    x: i % 2 === 0 ? -72 : 72,
                    y: 28,
                    opacity: 0
                });
            });

            const featuresTl = gsap.timeline({
                scrollTrigger: {
                    trigger: aboutFeaturesSection || aboutFeaturesGrid,
                    start: "top 75%",
                    once: true
                }
            });

            if (featuresBadge) {
                featuresTl.to(featuresBadge, { y: 0, opacity: 1, duration: 0.75, ease: "power2.out" });
            }
            featuresTl.to('.about-features-word', {
                opacity: 1,
                y: 0,
                filter: "blur(0px)",
                stagger: 0.055,
                duration: 0.8,
                ease: "power3.out"
            }, "-=0.35");
            featuresTl.to(aboutFeatureCards, {
                x: 0,
                y: 0,
                opacity: 1,
                duration: 0.9,
                stagger: 0.13,
                ease: "power3.out"
            }, "-=0.45");
        }

        const aboutStrengthsGrid = aboutPage.querySelector('.about-strengths-grid');
        if (aboutStrengthsGrid) {
            gsap.set(aboutStrengthsGrid, { perspective: 1500 });
            const strengthCards = aboutStrengthsGrid.querySelectorAll('.about-strength-card');
            gsap.set(strengthCards, {
                y: 120,
                opacity: 0,
                scale: 0.85,
                rotationX: 30,
                transformOrigin: "50% 100%"
            });
            ScrollTrigger.batch(strengthCards, {
                start: "top 85%",
                onEnter: batch => {
                    gsap.to(batch, {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        rotationX: 0,
                        duration: 1.4,
                        stagger: 0.15,
                        ease: "expo.out",
                        overwrite: true
                    });
                }
            });
        }

        const aboutLeadershipGrid = aboutPage.querySelector('.about-leadership-grid');
        if (aboutLeadershipGrid) {
            const leaderCards = aboutLeadershipGrid.querySelectorAll('.about-leader-card');
            const leadershipSection = aboutLeadershipGrid.closest('section');
            const leadershipHeader = leadershipSection ? leadershipSection.querySelector('.section-header-gap') : null;
            const leadershipItems = leadershipHeader ? [leadershipHeader, ...leaderCards] : [...leaderCards];
            gsap.from(leadershipItems, {
                scrollTrigger: {
                    trigger: leadershipSection || aboutLeadershipGrid,
                    start: "top 75%",
                    once: true
                },
                y: 80,
                opacity: 0,
                scale: 0.95,
                duration: 1.2,
                stagger: 0.2,
                ease: "back.out(1.4)"
            });
        }

        const aboutGlobalSection = aboutPage.querySelector('.global-network-section');
        if (aboutGlobalSection) {
            const globalHeader = aboutGlobalSection.querySelector('.section-header-gap');
            if (globalHeader) {
                gsap.from(globalHeader, {
                    scrollTrigger: {
                        trigger: aboutGlobalSection,
                        start: "top 75%",
                        once: true
                    },
                    y: 80,
                    opacity: 0,
                    scale: 0.95,
                    duration: 1.2,
                    ease: "back.out(1.4)"
                });
            }
        }

        const aboutStagesGrid = aboutPage.querySelector('.about-stages-grid');
        if (aboutStagesGrid) {
            gsap.set(aboutStagesGrid, { perspective: 1500 });
            const stagesMedia = aboutStagesGrid.querySelector('.about-stages-media');
            const stagesContent = aboutStagesGrid.querySelector('.about-stages-content');
            const stagesItems = [stagesMedia, stagesContent].filter(Boolean);

            gsap.set(stagesItems, {
                y: 120,
                opacity: 0,
                scale: 0.85,
                rotationX: 30,
                transformOrigin: "50% 100%"
            });

            ScrollTrigger.batch(stagesItems, {
                start: "top 85%",
                onEnter: batch => {
                    gsap.to(batch, {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        rotationX: 0,
                        duration: 1.4,
                        stagger: 0.15,
                        ease: "expo.out",
                        overwrite: true
                    });
                }
            });
        }

        const aboutCareersSection = aboutPage.querySelector('.about-careers-section');
        if (aboutCareersSection) {
            const careersHeader = aboutCareersSection.querySelector('.section-header-gap');
            const careerCards = aboutCareersSection.querySelectorAll('.about-career-card');
            const careersItems = careersHeader ? [careersHeader, ...careerCards] : [...careerCards];
            gsap.from(careersItems, {
                scrollTrigger: {
                    trigger: aboutCareersSection,
                    start: "top 75%",
                    once: true
                },
                y: 80,
                opacity: 0,
                scale: 0.95,
                duration: 1.2,
                stagger: 0.2,
                ease: "back.out(1.4)"
            });
        }

        const aboutCertGrid = aboutPage.querySelector('.about-cert-grid');
        if (aboutCertGrid) {
            gsap.set(aboutCertGrid, { perspective: 1500 });
            const certCards = aboutCertGrid.querySelectorAll('.about-cert-card');
            gsap.set(certCards, {
                y: 120,
                opacity: 0,
                scale: 0.85,
                rotationX: 30,
                transformOrigin: "50% 100%"
            });
            ScrollTrigger.batch(certCards, {
                start: "top 85%",
                onEnter: batch => {
                    gsap.to(batch, {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        rotationX: 0,
                        duration: 1.4,
                        stagger: 0.15,
                        ease: "expo.out",
                        overwrite: true
                    });
                }
            });
        }
    }

    // ==========================================
    // CONTACT PAGE SCROLL ANIMATIONS
    // ==========================================
    const contactPage = document.querySelector('.page-contact');
    if (contactPage) {
        const writeSection = contactPage.querySelector('#write-to-us');
        if (writeSection) {
            const formIntro = writeSection.querySelector('.contact-form-intro');
            const formRows = writeSection.querySelectorAll('.contact-form-row');
            const formActions = writeSection.querySelector('.contact-form-actions');
            const mapWrap = writeSection.querySelector('.contact-map-wrap');
            const mapIframe = mapWrap ? mapWrap.querySelector('.contact-map-iframe') : null;
            const formFields = [...formRows, formActions].filter(Boolean);

            if (formIntro) gsap.set(formIntro, { x: -55, opacity: 0, filter: "blur(8px)" });
            if (formFields.length) gsap.set(formFields, { y: 36, opacity: 0, filter: "blur(5px)" });
            if (mapWrap) {
                gsap.set(mapWrap, { clipPath: "inset(0 0 0 100%)", opacity: 0 });
                if (mapIframe) gsap.set(mapIframe, { scale: 1.14 });
            }

            const writeTl = gsap.timeline({
                scrollTrigger: {
                    trigger: writeSection,
                    start: "top 78%",
                    once: true
                }
            });

            if (formIntro) {
                writeTl.to(formIntro, {
                    x: 0,
                    opacity: 1,
                    filter: "blur(0px)",
                    duration: 0.95,
                    ease: "power3.out"
                }, 0);
            }
            if (formFields.length) {
                writeTl.to(formFields, {
                    y: 0,
                    opacity: 1,
                    filter: "blur(0px)",
                    duration: 0.8,
                    stagger: 0.11,
                    ease: "power2.out"
                }, 0.15);
            }
            if (mapWrap) {
                writeTl.to(mapWrap, {
                    clipPath: "inset(0 0 0 0%)",
                    opacity: 1,
                    duration: 1.15,
                    ease: "power3.inOut"
                }, 0.05);
                if (mapIframe) {
                    writeTl.to(mapIframe, { scale: 1, duration: 1.25, ease: "power2.out" }, "<");
                }
            }
        }

        const locationsSection = contactPage.querySelector('.contact-locations-section');
        if (locationsSection) {
            const locHeader = locationsSection.querySelector('.section-header-gap');
            const locBadge = locHeader ? locHeader.querySelector('.section-badge') : null;
            const locHeading = locationsSection.querySelector('.section-title');
            const locCards = locationsSection.querySelectorAll('.contact-location-card');

            if (locHeading && !locHeading.classList.contains('split-done')) {
                const locText = locHeading.textContent;
                locHeading.innerHTML = locText.split(" ").map(w => `<span class='contact-loc-word' style='display:inline-block; opacity:0; transform:translateY(40px); filter:blur(6px);'>${w}&nbsp;</span>`).join("");
                locHeading.classList.add('split-done');
            }

            if (locBadge) gsap.set(locBadge, { y: 18, opacity: 0 });
            locCards.forEach((card, i) => {
                gsap.set(card, {
                    x: i % 2 === 0 ? -72 : 72,
                    y: 28,
                    opacity: 0
                });
            });

            const locTl = gsap.timeline({
                scrollTrigger: {
                    trigger: locationsSection,
                    start: "top 75%",
                    once: true
                }
            });

            if (locBadge) {
                locTl.to(locBadge, { y: 0, opacity: 1, duration: 0.75, ease: "power2.out" });
            }
            locTl.to('.contact-loc-word', {
                opacity: 1,
                y: 0,
                filter: "blur(0px)",
                stagger: 0.055,
                duration: 0.8,
                ease: "power3.out"
            }, "-=0.35");
            locTl.to(locCards, {
                x: 0,
                y: 0,
                opacity: 1,
                duration: 0.9,
                stagger: 0.13,
                ease: "power3.out"
            }, "-=0.45");
        }

        const contactCareersSection = contactPage.querySelector('.contact-careers-section');
        if (contactCareersSection) {
            const careersHeader = contactCareersSection.querySelector('.section-header-gap');
            const careerCards = contactCareersSection.querySelectorAll('.contact-career-card');
            const cardEntrances = [
                { x: -55, y: 65, rotationY: -20, transformOrigin: "100% 50%" },
                { y: 95, scale: 0.86, transformOrigin: "50% 100%" },
                { x: 55, y: 65, rotationY: 20, transformOrigin: "0% 50%" }
            ];

            gsap.set(contactCareersSection, { perspective: 1300 });
            if (careersHeader) gsap.set(careersHeader, { y: 45, opacity: 0, filter: "blur(6px)" });
            careerCards.forEach((card, i) => {
                gsap.set(card, Object.assign({ opacity: 0 }, cardEntrances[i] || { y: 50 }));
            });

            const careersTl = gsap.timeline({
                scrollTrigger: {
                    trigger: contactCareersSection,
                    start: "top 72%",
                    once: true
                }
            });

            if (careersHeader) {
                careersTl.to(careersHeader, {
                    y: 0,
                    opacity: 1,
                    filter: "blur(0px)",
                    duration: 0.95,
                    ease: "power2.out"
                });
            }

            careerCards.forEach((card, i) => {
                careersTl.to(card, {
                    x: 0,
                    y: 0,
                    scale: 1,
                    rotationY: 0,
                    opacity: 1,
                    duration: 1.05,
                    ease: "power3.out"
                }, i === 0 ? "-=0.55" : "-=0.82");
            });
        }
    }

    // ==========================================
    // CERTIFICATIONS PAGE SCROLL ANIMATIONS
    // ==========================================
    const certificationsPage = document.querySelector('.page-certifications');
    if (certificationsPage) {
        const certListingCards = certificationsPage.querySelectorAll('.cert-listing-card');

        certListingCards.forEach(card => {
            const frame = card.querySelector('.cert-listing-frame');
            const body = card.querySelector('.cert-listing-body');
            if (frame) {
                gsap.set(frame, { y: 36, opacity: 0, scale: 1.03, transformOrigin: "50% 100%" });
            }
            if (body) {
                gsap.set(body, { y: 36, opacity: 0 });
            }
        });

        ScrollTrigger.batch(certListingCards, {
            start: "top 88%",
            onEnter: batch => {
                batch.forEach((card, i) => {
                    const frame = card.querySelector('.cert-listing-frame');
                    const body = card.querySelector('.cert-listing-body');
                    const delay = i * 0.08;

                    if (frame) {
                        gsap.to(frame, {
                            y: 0,
                            opacity: 1,
                            scale: 1,
                            duration: 0.85,
                            ease: "power3.out",
                            delay,
                            overwrite: true
                        });
                    }
                    if (body) {
                        gsap.to(body, {
                            y: 0,
                            opacity: 1,
                            duration: 0.85,
                            ease: "power3.out",
                            delay,
                            overwrite: true
                        });
                    }
                });
            }
        });
    }

    // ==========================================
    // CLIENTS PAGE SCROLL ANIMATIONS
    // ==========================================
    const clientsPage = document.querySelector('.page-clients');
    if (clientsPage) {
        const introSection = clientsPage.querySelector('.clients-intro-section');
        if (introSection) {
            const introLeft = introSection.querySelector('.clients-intro-left');
            const introRight = introSection.querySelector('.clients-intro-right');

            if (introLeft) gsap.set(introLeft, { y: 36, opacity: 0 });
            if (introRight) gsap.set(introRight, { y: 36, opacity: 0 });

            const introTl = gsap.timeline({
                scrollTrigger: {
                    trigger: introSection,
                    start: "top 78%",
                    once: true
                }
            });

            if (introLeft) {
                introTl.to(introLeft, { y: 0, opacity: 1, duration: 0.85, ease: "power3.out" }, 0);
            }
            if (introRight) {
                introTl.to(introRight, { y: 0, opacity: 1, duration: 0.85, ease: "power3.out" }, 0);
            }
        }

        const logosSection = clientsPage.querySelector('.clients-logos-section');
        if (logosSection) {
            const logosHeader = logosSection.querySelector('.clients-logos-header');
            const logosBadge = logosHeader ? logosHeader.querySelector('.section-badge') : null;
            const logosTitle = logosSection.querySelector('.clients-logos-title');
            const logoCards = logosSection.querySelectorAll('.clients-logo-card');

            if (logosTitle && !logosTitle.classList.contains('split-done')) {
                const logosTitleText = logosTitle.textContent;
                logosTitle.innerHTML = logosTitleText.split(" ").map(w => `<span class='clients-logo-word' style='display:inline-block; opacity:0; transform:translateY(36px); filter:blur(6px);'>${w}&nbsp;</span>`).join("");
                logosTitle.classList.add('split-done');
            }

            if (logosBadge) gsap.set(logosBadge, { y: 16, opacity: 0 });
            logoCards.forEach(card => {
                gsap.set(card, { y: 28, opacity: 0, scale: 0.94 });
            });

            const logosTl = gsap.timeline({
                scrollTrigger: {
                    trigger: logosSection,
                    start: "top 80%",
                    once: true
                }
            });

            if (logosBadge) {
                logosTl.to(logosBadge, { y: 0, opacity: 1, duration: 0.7, ease: "power2.out" });
            }
            logosTl.to('.clients-logo-word', {
                opacity: 1,
                y: 0,
                filter: "blur(0px)",
                stagger: 0.045,
                duration: 0.75,
                ease: "power3.out"
            }, "-=0.35");

            ScrollTrigger.batch(logoCards, {
                start: "top 92%",
                onEnter: batch => {
                    gsap.to(batch, {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        duration: 0.72,
                        stagger: 0.05,
                        ease: "power2.out",
                        overwrite: true
                    });
                }
            });
        }
    }

    // ==========================================
    // EVENTS PAGE SCROLL ANIMATIONS
    // ==========================================
    const eventsPage = document.querySelector('.page-events');
    if (eventsPage) {
        const eventCards = eventsPage.querySelectorAll('.events-listing-card');

        eventCards.forEach(card => {
            const image = card.querySelector('.events-listing-image');
            const body = card.querySelector('.events-listing-body');
            if (image) {
                gsap.set(image, { y: 36, opacity: 0, scale: 1.04, transformOrigin: "50% 100%" });
            }
            if (body) {
                gsap.set(body, { y: 36, opacity: 0 });
            }
        });

        ScrollTrigger.batch(eventCards, {
            start: "top 88%",
            onEnter: batch => {
                batch.forEach((card, i) => {
                    const image = card.querySelector('.events-listing-image');
                    const body = card.querySelector('.events-listing-body');
                    const delay = i * 0.08;

                    if (image) {
                        gsap.to(image, {
                            y: 0,
                            opacity: 1,
                            scale: 1,
                            duration: 0.85,
                            ease: "power3.out",
                            delay,
                            overwrite: true
                        });
                    }
                    if (body) {
                        gsap.to(body, {
                            y: 0,
                            opacity: 1,
                            duration: 0.85,
                            ease: "power3.out",
                            delay,
                            overwrite: true
                        });
                    }
                });
            }
        });
    }

    // ==========================================
    // BLOG LISTING PAGE SCROLL ANIMATIONS
    // ==========================================
    const blogsPage = document.querySelector('.page-blogs');
    if (blogsPage) {
        const listingCards = blogsPage.querySelectorAll('.blog-listing-card');

        listingCards.forEach(card => {
            const image = card.querySelector('.blog-listing-image');
            const body = card.querySelectorAll('.blog-listing-meta, .blog-listing-title, .blog-listing-desc');
            const cardParts = [image, ...body].filter(Boolean);
            gsap.set(cardParts, { y: 36, opacity: 0 });
            if (image) gsap.set(image, { scale: 1.04, transformOrigin: "50% 100%" });
        });

        ScrollTrigger.batch(listingCards, {
            start: "top 88%",
            onEnter: batch => {
                batch.forEach((card, i) => {
                    const image = card.querySelector('.blog-listing-image');
                    const body = card.querySelectorAll('.blog-listing-meta, .blog-listing-title, .blog-listing-desc');
                    const cardParts = [image, ...body].filter(Boolean);

                    gsap.to(cardParts, {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        duration: 0.85,
                        ease: "power3.out",
                        delay: i * 0.07,
                        overwrite: true
                    });
                });
            }
        });
    }

    // ==========================================
    // BLOG DETAIL PAGE SCROLL ANIMATIONS
    // ==========================================
    const blogDetailPage = document.querySelector('.page-blog-detail');
    if (blogDetailPage) {
        const article = blogDetailPage.querySelector('.blog-detail-article');
        const detailHeader = blogDetailPage.querySelector('.blog-detail-header');
        const detailBadge = detailHeader ? detailHeader.querySelector('.section-badge') : null;
        const detailTitle = blogDetailPage.querySelector('.blog-detail-title');
        const featured = blogDetailPage.querySelector('.blog-detail-featured');
        const featuredImg = featured ? featured.querySelector('img') : null;
        const contentBlocks = blogDetailPage.querySelectorAll('.blog-detail-content > *');
        const cta = blogDetailPage.querySelector('.blog-detail-cta');
        const ctaBg = cta ? cta.querySelector('.blog-detail-cta-bg') : null;
        const ctaInner = cta ? cta.querySelector('.blog-detail-cta-inner') : null;
        const relatedSection = blogDetailPage.querySelector('.blog-detail-related');

        if (detailTitle && !detailTitle.classList.contains('split-done')) {
            const titleText = detailTitle.textContent;
            detailTitle.innerHTML = titleText.split(" ").map(w => `<span class='blog-detail-word' style='display:inline-block; opacity:0; transform:translateY(50px); filter:blur(8px);'>${w}&nbsp;</span>`).join("");
            detailTitle.classList.add('split-done');
        }

        if (article) {
            const articleTl = gsap.timeline({
                scrollTrigger: {
                    trigger: article,
                    start: "top 85%",
                    once: true
                }
            });

            if (detailBadge) {
                gsap.set(detailBadge, { y: 14, opacity: 0 });
                articleTl.to(detailBadge, { y: 0, opacity: 1, duration: 0.7, ease: "power2.out" });
            }

            articleTl.to('.blog-detail-word', {
                opacity: 1,
                y: 0,
                filter: "blur(0px)",
                stagger: 0.035,
                duration: 0.75,
                ease: "power3.out"
            }, "-=0.35");

            if (featured) {
                gsap.set(featured, { clipPath: "inset(0 100% 0 0)", opacity: 0 });
                if (featuredImg) gsap.set(featuredImg, { scale: 1.16 });
                articleTl.to(featured, {
                    clipPath: "inset(0 0 0 0)",
                    opacity: 1,
                    duration: 1.05,
                    ease: "power3.inOut"
                }, "-=0.5");
                if (featuredImg) {
                    articleTl.to(featuredImg, { scale: 1, duration: 1.2, ease: "power2.out" }, "<");
                }
            }
        }

        if (contentBlocks.length) {
            gsap.set(contentBlocks, { y: 30, opacity: 0 });
            ScrollTrigger.batch(contentBlocks, {
                start: "top 90%",
                onEnter: batch => {
                    gsap.to(batch, {
                        y: 0,
                        opacity: 1,
                        duration: 0.8,
                        stagger: 0.06,
                        ease: "power2.out",
                        overwrite: true
                    });
                }
            });
        }

        if (cta && ctaBg) {
            gsap.set(ctaBg, { scale: 0.94, opacity: 0, transformOrigin: "50% 50%" });
            if (ctaInner) gsap.set(ctaInner.children, { y: 24, opacity: 0 });

            const ctaTl = gsap.timeline({
                scrollTrigger: {
                    trigger: cta,
                    start: "top 80%",
                    once: true
                }
            });

            ctaTl.to(ctaBg, { scale: 1, opacity: 1, duration: 0.95, ease: "power2.out" });
            if (ctaInner) {
                ctaTl.to(ctaInner.children, {
                    y: 0,
                    opacity: 1,
                    duration: 0.75,
                    stagger: 0.1,
                    ease: "power2.out"
                }, "-=0.55");
            }
        }

        if (relatedSection) {
            const relatedHeader = relatedSection.querySelector('.section-header-gap');
            const relatedBadge = relatedHeader ? relatedHeader.querySelector('.section-badge') : null;
            const relatedHeading = relatedSection.querySelector('.section-title');
            const relatedCards = relatedSection.querySelectorAll('.blog-listing-card');
            const viewAllBtn = relatedSection.querySelector('.action-btn-wrapper');

            if (relatedHeading && !relatedHeading.classList.contains('split-done')) {
                relatedHeading.innerHTML = relatedHeading.textContent.split(" ").map(w => `<span class='blog-related-word' style='display:inline-block; opacity:0; transform:translateY(30px);'>${w}&nbsp;</span>`).join("");
                relatedHeading.classList.add('split-done');
            }

            relatedCards.forEach((card, i) => {
                gsap.set(card, {
                    y: 48,
                    opacity: 0,
                    x: i % 3 === 0 ? -22 : i % 3 === 2 ? 22 : 0
                });
            });
            if (viewAllBtn) gsap.set(viewAllBtn, { y: 20, opacity: 0 });

            const relatedTl = gsap.timeline({
                scrollTrigger: {
                    trigger: relatedSection,
                    start: "top 78%",
                    once: true
                }
            });

            if (relatedBadge) {
                gsap.set(relatedBadge, { y: 12, opacity: 0 });
                relatedTl.to(relatedBadge, { y: 0, opacity: 1, duration: 0.65, ease: "power2.out" });
            }
            relatedTl.to('.blog-related-word', {
                opacity: 1,
                y: 0,
                stagger: 0.05,
                duration: 0.7,
                ease: "power3.out"
            }, "-=0.3");
            relatedTl.to(relatedCards, {
                y: 0,
                x: 0,
                opacity: 1,
                duration: 0.85,
                stagger: 0.12,
                ease: "power3.out"
            }, "-=0.35");
            if (viewAllBtn) {
                relatedTl.to(viewAllBtn, { y: 0, opacity: 1, duration: 0.7, ease: "power2.out" }, "-=0.4");
            }
        }
    }

    // ==========================================
    // FOOTER ANIMATION (Dramatic 3D & Split Text)
    // ==========================================
    const footer = document.querySelector('.main-footer');
    if (footer) {
        // Manually split the tagline into words for a premium staggered word reveal
        const tagline = document.querySelector('.footer-tagline');
        if (tagline && !tagline.classList.contains('split-done')) {
            const text = tagline.innerText;
            tagline.innerHTML = text.split(' ').map(word => `<span style="display:inline-block; overflow:hidden; vertical-align:bottom;"><span style="display:inline-block;" class="tag-word">${word}</span></span>`).join(' ');
            tagline.classList.add('split-done');
        }

        const footerTl = gsap.timeline({
            scrollTrigger: {
                trigger: footer,
                start: "top 85%", // Trigger right as the top enters
                once: true
            }
        });

        // 1. Logo drops in with a dramatic 3D spin
        footerTl.from('.footer-logo-area', {
            scale: 0,
            rotationY: 360,
            opacity: 0,
            duration: 1.2,
            ease: "back.out(1.5)"
        });

        // 2. Tagline words stagger up 
        footerTl.from('.tag-word', {
            y: "150%",
            rotationZ: 15,
            opacity: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: "power3.out"
        }, "-=0.8");

        // 3. Dividers shoot out with extreme velocity from the left
        footerTl.from('.footer-divider1, .footer-divider2', {
            scaleX: 0,
            opacity: 0,
            transformOrigin: "left",
            duration: 1.2,
            ease: "expo.out"
        }, "-=0.4");

        // 4. Content boxes swing down from the top (3D hinge effect)
        gsap.set('.footer-middle-grid', { perspective: 2000 });
        footerTl.from('.footer-box-left, .footer-box-right', {
            rotationX: -90,
            y: -50,
            opacity: 0,
            transformOrigin: "top center",
            duration: 1.2,
            ease: "back.out(1.2)"
        }, "-=1.0");
    }

    // --- DYNAMIC DROPDOWN DOWN-ARROW INJECTION & ANIMATION ---
    const megaTriggers = document.querySelectorAll('.nav-mega-trigger');
    megaTriggers.forEach(trigger => {
        const dot = trigger.querySelector('.dot');

        // Create the down arrow container
        const arrowSpan = document.createElement('span');
        arrowSpan.className = 'mega-down-arrow';
        arrowSpan.style.display = 'none'; // Hidden by default
        arrowSpan.style.alignItems = 'center';
        arrowSpan.style.justifyContent = 'center';
        arrowSpan.style.marginLeft = '10px';
        arrowSpan.innerHTML = '<svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 7L13 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

        trigger.appendChild(arrowSpan);

        // Function to toggle dot/arrow visibility based on screen width
        const updateIconVisibility = () => {
            if (window.innerWidth <= 1080) {
                // Mobile: Hide dot, show arrow
                if (dot) dot.style.setProperty('display', 'none', 'important');
                arrowSpan.style.setProperty('display', 'inline-flex', 'important');
            } else {
                // Desktop: Show dot, hide arrow
                if (dot) dot.style.setProperty('display', 'inline-block', 'important');
                arrowSpan.style.setProperty('display', 'none', 'important');
            }
        };

        // Run on load and on resize
        updateIconVisibility();
        window.addEventListener('resize', updateIconVisibility);

        // Animate the arrow using GSAP when clicked
        let isOpen = false;
        trigger.addEventListener('click', (e) => {
            if (window.innerWidth <= 1080) {
                // Let the main script.js handle the CSS classes, we just animate the rotation
                isOpen = !isOpen;
                gsap.to(arrowSpan, {
                    rotation: isOpen ? 180 : 0,
                    color: isOpen ? 'var(--primary-red)' : 'var(--primary-purple)',
                    duration: 0.4,
                    ease: 'power2.out'
                });
            }
        });
    });

});
