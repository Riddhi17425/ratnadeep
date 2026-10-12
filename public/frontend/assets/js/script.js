/* ==========================================================================
   PAGE LOADER
   ========================================================================== */
(function () {
    var loader = document.getElementById('siteLoader');
    if (!loader) return;

    var bar = document.getElementById('loaderBar');
    var percentText = document.getElementById('loaderPercent');
    var progress = 0;
    var pageLoaded = false;
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function setProgress(val) {
        progress = Math.min(val, 100);
        if (bar) bar.style.width = progress + '%';
        if (percentText) percentText.textContent = Math.floor(progress) + '%';
    }

    // Climb to 90% while real assets are still loading, then wait for window 'load'
    var climbInterval = setInterval(function () {
        if (progress >= 90) {
            clearInterval(climbInterval);
            return;
        }
        var step = reduceMotion ? 15 : Math.max(1, (90 - progress) / 12);
        setProgress(progress + step);
    }, 120);

    function finishLoading() {
        if (pageLoaded) return;
        pageLoaded = true;
        clearInterval(climbInterval);
        setProgress(100);
        setTimeout(function () {
            loader.classList.add('is-loaded');
        }, reduceMotion ? 100 : 350);
    }

    window.addEventListener('load', finishLoading);

    // Safety fallback in case 'load' never fires (slow third-party scripts etc.)
    setTimeout(finishLoading, 6000);
})();

document.addEventListener('DOMContentLoaded', () => {
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
            // Close mobile menu if open when a link is clicked
            const mainNav = document.querySelector('.main-nav');
            const menuToggle = document.querySelector('.mobile-menu-toggle');
            if (mainNav && mainNav.classList.contains('nav-active')) {
                mainNav.classList.remove('nav-active');
                menuToggle.classList.remove('is-active');
            }
        });
    });

    // Mobile Menu Toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    if (mobileMenuToggle && mainNav) {
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenuToggle.classList.toggle('is-active');
            mainNav.classList.toggle('nav-active');
        });
    }

    // Products mega menu
    (function initProductsMegaMenu() {
        const header = document.querySelector('.header');
        const megaMenu = document.getElementById('productsMegaMenu');
        const megaBackdrop = document.getElementById('productsMegaBackdrop');
        const megaTrigger = document.querySelector('.nav-mega-trigger');
        const megaNavItem = document.querySelector('.nav-item-has-mega');
        if (!header || !megaMenu || !megaTrigger || !megaNavItem) return;

        let closeTimer = null;
        const desktopQuery = window.matchMedia('(min-width: 1081px)');
        const isDesktop = () => desktopQuery.matches;

        function updateHeaderBottom() {
            document.documentElement.style.setProperty('--header-bottom', header.getBoundingClientRect().bottom + 'px');
        }

        function openMega() {
            clearTimeout(closeTimer);
            header.classList.add('is-mega-open');
            megaNavItem.classList.add('is-open');
            megaTrigger.setAttribute('aria-expanded', 'true');
            megaMenu.setAttribute('aria-hidden', 'false');
            if (megaBackdrop) megaBackdrop.setAttribute('aria-hidden', 'false');
            updateHeaderBottom();
        }

        function closeMega() {
            header.classList.remove('is-mega-open');
            megaNavItem.classList.remove('is-open');
            megaTrigger.setAttribute('aria-expanded', 'false');
            megaMenu.setAttribute('aria-hidden', 'true');
            if (megaBackdrop) megaBackdrop.setAttribute('aria-hidden', 'true');
        }

        function scheduleClose() {
            clearTimeout(closeTimer);
            closeTimer = setTimeout(closeMega, 180);
        }

        function bindDesktopHover() {
            if (!isDesktop()) return;
            megaNavItem.addEventListener('mouseenter', openMega);
            megaMenu.addEventListener('mouseenter', openMega);
            header.addEventListener('mouseleave', scheduleClose);
            megaNavItem.addEventListener('mouseleave', scheduleClose);
            megaMenu.addEventListener('mouseleave', scheduleClose);
        }

        bindDesktopHover();

        if (megaBackdrop) {
            megaBackdrop.addEventListener('click', closeMega);
        }

        megaTrigger.addEventListener('click', function (e) {
            if (!isDesktop()) {
                e.preventDefault();
                if (header.classList.contains('is-mega-open')) {
                    closeMega();
                } else {
                    openMega();
                }
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMega();
        });

        window.addEventListener('resize', updateHeaderBottom);
        window.addEventListener('scroll', updateHeaderBottom, { passive: true });
        updateHeaderBottom();

        desktopQuery.addEventListener('change', function () {
            closeMega();
            updateHeaderBottom();
        });
    })();

    // Simple reveal animation on scroll for feature cards
    const cards = document.querySelectorAll('.feature-card');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease-out';
        observer.observe(card);
    });

    // Language Dropdown Selection
    const langOptions = document.querySelectorAll('.lang-option');
    const selectedLanguageText = document.getElementById('selectedLanguage');
    const languageDropdownBtn = document.getElementById('languageDropdown');
    const customDropdownMenu = document.querySelector('.custom-dropdown-menu');

    if (languageDropdownBtn && customDropdownMenu) {
        languageDropdownBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            customDropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function (e) {
            if (!languageDropdownBtn.contains(e.target) && !customDropdownMenu.contains(e.target)) {
                customDropdownMenu.classList.remove('show');
            }
        });
    }

    langOptions.forEach(option => {
        option.addEventListener('click', function (e) {
            e.preventDefault();
            const lang = this.getAttribute('data-lang');
            if (selectedLanguageText) {
                selectedLanguageText.textContent = lang;
            }
            if (customDropdownMenu) {
                customDropdownMenu.classList.remove('show');
            }
        });
    });
});

$(document).ready(function () {
    // Initialize Slick Slider
    var $heroSlider = $('.hero-slick-slider');

    if ($heroSlider.length) {
        $heroSlider.slick({
            autoplay: true,
            autoplaySpeed: 5500, // Show each slide longer
            speed: 1000, // Slower, smoother fade transition
            fade: true,
            cssEase: 'ease-in-out',
            arrows: false,
            dots: false,
            pauseOnHover: false
        });

        // Update active tab on slide change
        $heroSlider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var $nextSlideEl = $(slick.$slides.get(nextSlide));
            var categoryId = $nextSlideEl.data('category-id');

            $('.hero-product-tabs .tab-item').removeClass('active');
            if (categoryId) {
                $('.hero-product-tabs .tab-item[data-category-id="' + categoryId + '"]').addClass('active');
            } else {
                $('.hero-product-tabs .tab-item[data-slide="' + nextSlide + '"]').addClass('active');
            }
        });

        // Click on tabs to go to slide
        $('.hero-product-tabs .tab-item').on('click', function (e) {
            e.preventDefault();
            var slideIndex = $(this).data('slide');
            $heroSlider.slick('slickGoTo', slideIndex);
        });
    }

    // Scroll Text Reveal Effect
    if ($('.reveal-text').length) {
        // Wrap words in spans
        $('.reveal-text').each(function () {
            var $this = $(this);
            var words = $this.text().trim().split(/\s+/);
            $this.empty();
            $.each(words, function (i, word) {
                $this.append($('<span class="reveal-word">').text(word + ' '));
            });
        });

        // Scroll listener
        $(window).on('scroll resize', function () {
            var windowHeight = $(window).height();

            $('.reveal-group').each(function () {
                var $group = $(this);
                var $words = $group.find('.reveal-word');
                if ($words.length === 0) return;

                var rect = this.getBoundingClientRect();

                // Start revealing when the top of the group hits 85% of screen height
                var revealStart = windowHeight * 0.85;
                // Finish revealing when the bottom of the group hits 30% of screen height
                // Which means top of group is at: 30% of screen - group height
                var revealEnd = (windowHeight * 0.3) - rect.height;

                var progress = (revealStart - rect.top) / (revealStart - revealEnd);

                if (progress < 0) progress = 0;
                if (progress > 1) progress = 1;

                var totalWords = $words.length;

                $words.each(function (index) {
                    var wordProgress = (progress * totalWords) - index;
                    if (wordProgress >= 1) {
                        $(this).css('opacity', '1');
                    } else if (wordProgress > 0) {
                        $(this).css('opacity', 0.15 + (0.85 * wordProgress));
                    } else {
                        $(this).css('opacity', '0.15');
                    }
                });
            });
        });

        // Trigger on load
        setTimeout(function () {
            $(window).trigger('scroll');
        }, 100);
    }

    // Stats Counter Animation
    if ($('.counter-value').length) {
        var counted = false;
        var statsSection = document.querySelector('.stats-grid');

        if (statsSection) {
            var counterObserver = new IntersectionObserver(function (entries) {
                if (entries[0].isIntersecting && !counted) {
                    counted = true;

                    // Trigger staggered fade-in for stat items
                    $('.stat-item').each(function (index) {
                        var $item = $(this);
                        setTimeout(function () {
                            $item.addClass('is-visible');
                        }, index * 150);
                    });

                    $('.counter-value').each(function () {
                        var $this = $(this);
                        var targetNum = parseInt($this.attr('data-target'));

                        $({ countNum: 0 }).animate({
                            countNum: targetNum
                        },
                            {
                                duration: 2500, // 2.5 seconds for a premium feel
                                easing: 'swing',
                                step: function () {
                                    $this.text(Math.floor(this.countNum).toLocaleString('en-IN'));
                                },
                                complete: function () {
                                    $this.text(this.countNum.toLocaleString('en-IN'));
                                }
                            });
                    });
                }
            }, {
                threshold: 0.8
            });

            counterObserver.observe(statsSection);
        }
    }

    // Map Scroll Reveal Animation
    var mapContainer = document.querySelector('.map-container');
    if (mapContainer) {
        var revealedMap = false;
        var mapObserver = new IntersectionObserver(function (entries) {
            if (entries[0].isIntersecting && !revealedMap) {
                revealedMap = true;
                $(mapContainer).addClass('is-visible');
            }
        }, {
            threshold: 0.3 // Trigger when 30% of the map section is visible
        });

        mapObserver.observe(mapContainer);
    }

    // Inline Video Playback
    $('.play-inline-video').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('href');

        if (url && url.indexOf('youtube.com') !== -1) {
            // Convert watch URL to embed URL and autoplay
            var embedUrl = url.replace("watch?v=", "embed/") + "?autoplay=1&rel=0";

            // Create responsive iframe wrapper
            var iframeHtml = '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; border-radius: 5px;">' +
                '<iframe src="' + embedUrl + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ' +
                'style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>' +
                '</div>';

            // Replace the anchor tag with the iframe
            $this.replaceWith(iframeHtml);
        }
    });

    // Events Slick Slider
    if ($('.events-slider').length) {
        var $eventsSlider = $('.events-slider');

        $eventsSlider.slick({
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 800,
            arrows: false,
            dots: false, // Don't use slick's default dots, use the existing ones
            fade: true,
            cssEase: 'ease-in-out'
        });

        // Sync their original custom indicators with the slider
        $eventsSlider.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            $('.slider-indicators .indicator').removeClass('active');
            $('.slider-indicators .indicator').eq(nextSlide).addClass('active');
        });

        $('.slider-indicators .indicator').on('click', function () {
            var slideIndex = $(this).index();
            $eventsSlider.slick('slickGoTo', slideIndex);
        });
    }

    // Common Mobile Slick Slider
    function initMobileSliders() {
        var $mobileSliders = $('.mobile-slider');
        if ($mobileSliders.length === 0) return;

        var slickOptions = {
            dots: true,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            adaptiveHeight: false
        };

        function checkMobileSlider() {
            if ($(window).width() <= 768) {
                $mobileSliders.each(function () {
                    if (!$(this).hasClass('slick-initialized')) {
                        $(this).slick(slickOptions);
                    }
                });
            } else {
                $mobileSliders.each(function () {
                    if ($(this).hasClass('slick-initialized')) {
                        $(this).slick('unslick');
                    }
                });
            }
        }

        // Initialize on load and check on resize
        checkMobileSlider();
        $(window).on('resize', function () {
            checkMobileSlider();
        });
    }
    initMobileSliders();

    // Initialize Fancybox
    if (typeof Fancybox !== "undefined") {
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    }
});