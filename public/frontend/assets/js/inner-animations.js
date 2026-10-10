/*
 * Scroll animations for the newer inner pages.
 *
 * Every page has its own scoped block (selected by its <main class="page-...">) and its own
 * animation style, so nothing here touches the existing pages or the homepage.
 * Relies on GSAP + ScrollTrigger (+ Lenis) that gsap-animations.js already sets up.
 *
 *  careers              - horizontal slides (rows, cards and form slide in from the sides)
 *  packaging-shipping   - clip-path wipes + pop-in cards, icons drop from above
 *  inspection           - 3D hinge cards, image wipes with parallax, word-by-word reading reveal
 *  applications         - masked image zoom reveal on a diagonal stagger
 *  products             - blur + skew rise, re-plays when the family filter changes
 *  product detail       - centre-out gallery reveal, count-up numbers, alternating table rows, chip pop
 */
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    gsap.registerPlugin(ScrollTrigger);

    // ---------- helpers ----------
    const all = (root, sel) => (root ? Array.from(root.querySelectorAll(sel)) : []);
    const isSmall = () => window.innerWidth <= 767;
    const dist = (n) => (isSmall() ? Math.round(n * 0.45) : n); // shorter travel on phones
    const CLEAR = 'transform,opacity,filter,clipPath';

    // Hide `items`, then reveal them in batches as they scroll into view.
    function batchReveal(items, from, to, opts = {}) {
        if (!items.length) return;
        gsap.set(items, from);
        ScrollTrigger.batch(items, {
            start: opts.start || 'top 88%',
            once: true,
            onEnter: (batch) => gsap.to(batch, Object.assign({
                opacity: 1,
                duration: 1,
                ease: 'power3.out',
                stagger: opts.stagger != null ? opts.stagger : 0.12,
                overwrite: true,
                clearProps: CLEAR
            }, to))
        });
    }

    // Hide a single element and reveal it once when it enters the viewport.
    function singleReveal(el, from, to, start) {
        if (!el) return;
        gsap.set(el, from);
        ScrollTrigger.create({
            trigger: el,
            start: start || 'top 88%',
            once: true,
            onEnter: () => gsap.to(el, Object.assign({
                opacity: 1,
                duration: 1.1,
                ease: 'power3.out',
                overwrite: true,
                clearProps: CLEAR
            }, to))
        });
    }

    // Section heading blocks (badge, title, lead) share a gentle rise on every page.
    function headings(root, fromVars) {
        all(root, '.inner-head, .inner-badge-wrap').forEach((head) => {
            if (head.closest('.inner-hero-section')) return;
            // the intro heading column is animated (and kept sticky) as a whole
            if (head.parentElement && head.parentElement.classList.contains('inner-split')) return;
            const parts = Array.from(head.children);
            if (!parts.length) return;
            batchReveal(parts, Object.assign({ opacity: 0, y: dist(30) }, fromVars || {}), { y: 0, x: 0 }, { stagger: 0.12 });
        });
    }

    // Split text nodes into words (keeps <strong> etc.) for a scrub-based reading reveal.
    function splitWords(el) {
        const words = [];
        const walk = (node) => {
            Array.from(node.childNodes).forEach((child) => {
                if (child.nodeType === 3) {
                    const frag = document.createDocumentFragment();
                    child.textContent.split(/(\s+)/).forEach((part) => {
                        if (!part) return;
                        if (/^\s+$/.test(part)) {
                            frag.appendChild(document.createTextNode(part));
                        } else {
                            const span = document.createElement('span');
                            span.textContent = part;
                            span.style.display = 'inline-block';
                            frag.appendChild(span);
                            words.push(span);
                        }
                    });
                    node.replaceChild(frag, child);
                } else if (child.nodeType === 1) {
                    walk(child);
                }
            });
        };
        walk(el);
        return words;
    }

    // =====================================================
    // CAREERS - horizontal slides
    // =====================================================
    const careers = document.querySelector('.page-careers');
    if (careers) {
        headings(careers, { y: 0, x: -dist(50) });

        const split = careers.querySelector('.inner-split');
        if (split) {
            const left = split.children[0];
            const right = split.children[1];
            singleReveal(left, { opacity: 0, x: -dist(80) }, { x: 0 });
            singleReveal(right, { opacity: 0, x: dist(80) }, { x: 0 });
        }

        const rows = all(careers, '.careers-role');
        batchReveal(rows, { opacity: 0, x: -dist(90) }, { x: 0, duration: 1.1 }, { stagger: 0.14 });

        // re-play when the area filter changes
        all(careers, '.inner-filter').forEach((btn) => {
            btn.addEventListener('click', () => {
                requestAnimationFrame(() => {
                    const visible = rows.filter((r) => !r.hidden);
                    gsap.fromTo(visible, { opacity: 0, x: -dist(50) }, { opacity: 1, x: 0, duration: 0.7, stagger: 0.08, ease: 'power3.out', overwrite: true, clearProps: CLEAR });
                    ScrollTrigger.refresh();
                });
            });
        });

        const cards = all(careers, '.careers-why .num-card');
        batchReveal(cards, { opacity: 0, y: dist(50), scale: 0.94 }, { y: 0, scale: 1, duration: 1 }, { stagger: 0.14 });

        const form = careers.querySelector('.careers-form');
        singleReveal(form, { opacity: 0, x: dist(70) }, { x: 0 });
        batchReveal(all(careers, '.careers-field'), { opacity: 0, x: -dist(40) }, { x: 0, duration: 0.8 }, { stagger: 0.08, start: 'top 92%' });

        const locCards = all(careers, '.careers-location-card');
        locCards.forEach((card, i) => {
            const fromLeft = i % 2 === 0;
            singleReveal(card, { opacity: 0, x: (fromLeft ? -1 : 1) * dist(90) }, { x: 0 }, 'top 90%');
        });

        const cta = careers.querySelector('.page-cta');
        singleReveal(cta, { opacity: 0, x: -dist(90) }, { x: 0, duration: 1.2 });
    }

    // =====================================================
    // PACKAGING & SHIPPING - clip-path wipes, pop-ins, drop-ins
    // =====================================================
    const packaging = document.querySelector('.page-packaging');
    if (packaging) {
        headings(packaging, { y: dist(30) });

        singleReveal(packaging.querySelector('.inner-lead--center'), { opacity: 0, y: dist(40), filter: 'blur(8px)' }, { y: 0, filter: 'blur(0px)' });

        // option cards: image box wipes up, copy follows
        all(packaging, '.packaging-options .inner-card').forEach((card) => {
            const media = card.querySelector('.inner-card-media');
            const copy = all(card, '.inner-card-title, .inner-card-text');
            gsap.set(media, { clipPath: 'inset(100% 0% 0% 0%)' });
            gsap.set(copy, { opacity: 0, y: dist(30) });
            ScrollTrigger.create({
                trigger: card,
                start: 'top 85%',
                once: true,
                onEnter: () => {
                    gsap.to(media, { clipPath: 'inset(0% 0% 0% 0%)', duration: 1.3, ease: 'expo.out', clearProps: 'clipPath' });
                    gsap.to(copy, { opacity: 1, y: 0, duration: 0.9, stagger: 0.12, delay: 0.45, ease: 'power3.out', clearProps: CLEAR });
                }
            });
        });

        // approach cards: pop in
        batchReveal(all(packaging, '.num-card'), { opacity: 0, scale: 0.8, y: dist(30) }, { scale: 1, y: 0, duration: 0.9, ease: 'back.out(1.5)' }, { stagger: 0.14 });

        // export section: image wipes left -> right, cards rise
        const exportMedia = packaging.querySelector('.inner-feature-media');
        if (exportMedia) {
            gsap.set(exportMedia, { clipPath: 'inset(0% 100% 0% 0% round 10px)' });
            ScrollTrigger.create({
                trigger: exportMedia,
                start: 'top 82%',
                once: true,
                onEnter: () => gsap.to(exportMedia, { clipPath: 'inset(0% 0% 0% 0% round 10px)', duration: 1.4, ease: 'expo.out', clearProps: 'clipPath' })
            });
        }
        singleReveal(packaging.querySelector('.inner-feature-head'), { opacity: 0, y: dist(40) }, { y: 0 });
        batchReveal(all(packaging, '.export-card'), { opacity: 0, y: dist(50), scale: 0.96 }, { y: 0, scale: 1, duration: 0.9 }, { stagger: 0.12 });

        // logistics icons drop in from above, dividers grow
        batchReveal(all(packaging, '.logistics-item'), { opacity: 0, y: -dist(70) }, { y: 0, duration: 1.1, ease: 'back.out(1.6)' }, { stagger: 0.18 });
        all(packaging, '.logistics-divider').forEach((line) => {
            gsap.set(line, { scaleY: 0, transformOrigin: 'center top' });
            ScrollTrigger.create({
                trigger: line,
                start: 'top 90%',
                once: true,
                onEnter: () => gsap.to(line, { scaleY: 1, duration: 0.9, ease: 'power3.out', clearProps: 'transform' })
            });
        });

        // FAQ rows slide in from the right
        batchReveal(all(packaging, '.faq-item'), { opacity: 0, x: dist(70) }, { x: 0, duration: 0.9 }, { stagger: 0.12 });
    }

    // =====================================================
    // INSPECTION & QUALITY TESTING - 3D hinge, wipes + parallax, reading reveal
    // =====================================================
    const inspection = document.querySelector('.page-inspection');
    if (inspection) {
        headings(inspection, { y: dist(30) });

        const split = inspection.querySelector('.inner-split');
        if (split) {
            singleReveal(split.children[0], { opacity: 0, y: dist(50) }, { y: 0 });
            batchReveal(all(split.children[1], 'p'), { opacity: 0, y: dist(40) }, { y: 0 }, { stagger: 0.18 });
        }

        // quality-approach cards hinge down from the top edge
        const approach = all(inspection, '.approach-card');
        if (approach.length) {
            gsap.set(approach, { transformPerspective: 1000, transformOrigin: 'top center' });
            batchReveal(approach, { opacity: 0, rotationX: -40, y: dist(40) }, { rotationX: 0, y: 0, duration: 1.2, ease: 'back.out(1.1)' }, { stagger: 0.16 });
        }

        // testing rows: image wipes in from its own side + soft parallax, copy + checklist stagger
        all(inspection, '.inner-feature').forEach((row) => {
            const reverse = row.classList.contains('inner-feature--reverse');
            const media = row.querySelector('.inner-feature-media');
            const img = media ? media.querySelector('img') : null;
            if (media) {
                gsap.set(media, { clipPath: reverse ? 'inset(0% 0% 0% 100% round 10px)' : 'inset(0% 100% 0% 0% round 10px)' });
                ScrollTrigger.create({
                    trigger: media,
                    start: 'top 82%',
                    once: true,
                    onEnter: () => gsap.to(media, { clipPath: 'inset(0% 0% 0% 0% round 10px)', duration: 1.4, ease: 'expo.out', clearProps: 'clipPath' })
                });
            }
            if (img && !isSmall()) {
                gsap.fromTo(img, { yPercent: -6, scale: 1.1 }, {
                    yPercent: 6,
                    scale: 1.1,
                    ease: 'none',
                    scrollTrigger: { trigger: media, start: 'top bottom', end: 'bottom top', scrub: true }
                });
                media.style.overflow = 'hidden';
            }
            singleReveal(row.querySelector('.inner-feature-head'), { opacity: 0, x: (reverse ? 1 : -1) * dist(50) }, { x: 0 });
            all(row, '.testing-list').forEach((list) => {
                batchReveal(all(list, 'li'), { opacity: 0, x: -dist(26) }, { x: 0, duration: 0.7 }, { stagger: 0.06, start: 'top 92%' });
            });
        });

        // reading reveal: words light up while scrolling through the paragraph
        const reading = inspection.querySelector('.capabilities-text');
        if (reading) {
            const words = splitWords(reading);
            gsap.set(words, { opacity: 0.15 });
            gsap.to(words, {
                opacity: 1,
                ease: 'none',
                stagger: 0.1,
                scrollTrigger: { trigger: reading, start: 'top 85%', end: 'bottom 45%', scrub: 0.6 }
            });
        }

        // why-quality cards: left column from the left, right column from the right
        all(inspection, '.num-card').forEach((card, i) => {
            singleReveal(card, { opacity: 0, x: (i % 2 === 0 ? -1 : 1) * dist(70), y: dist(20) }, { x: 0, y: 0 }, 'top 90%');
        });

        batchReveal(all(inspection, '.faq-item'), { opacity: 0, y: dist(30) }, { y: 0, duration: 0.8 }, { stagger: 0.1 });
    }

    // =====================================================
    // APPLICATIONS - masked image zoom on a diagonal stagger
    // =====================================================
    const applications = document.querySelector('.page-applications');
    if (applications) {
        headings(applications, { y: dist(30), scale: 0.96 });

        singleReveal(applications.querySelector('.inner-lead--center'), { opacity: 0, y: dist(40) }, { y: 0 });

        const cards = all(applications, '.apps-grid .inner-card');
        cards.forEach((card) => {
            const media = card.querySelector('.inner-card-media');
            const copy = all(card, '.inner-card-title, .inner-card-text');
            gsap.set(media, { clipPath: 'inset(14% 14% 14% 14% round 5px)', scale: 1.1, opacity: 0 });
            gsap.set(copy, { opacity: 0, y: dist(24) });
        });
        ScrollTrigger.batch(cards, {
            start: 'top 88%',
            once: true,
            onEnter: (batch) => {
                batch.forEach((card, i) => {
                    const media = card.querySelector('.inner-card-media');
                    const copy = all(card, '.inner-card-title, .inner-card-text');
                    const delay = i * 0.1;
                    gsap.to(media, { clipPath: 'inset(0% 0% 0% 0% round 5px)', scale: 1, opacity: 1, duration: 1.3, delay, ease: 'expo.out', clearProps: CLEAR });
                    gsap.to(copy, { opacity: 1, y: 0, duration: 0.85, delay: delay + 0.35, stagger: 0.1, ease: 'power3.out', clearProps: CLEAR });
                });
            }
        });

        batchReveal(all(applications, '.num-card'), { opacity: 0, scale: 0.88 }, { scale: 1, duration: 1 }, { stagger: { each: 0.12, from: 'center' } });
        singleReveal(applications.querySelectorAll('.inner-lead--center')[1], { opacity: 0, y: dist(40) }, { y: 0 });
        batchReveal(all(applications, '.faq-item'), { opacity: 0, x: -dist(60) }, { x: 0, duration: 0.9 }, { stagger: 0.12 });
    }

    // =====================================================
    // PRODUCTS LISTING - blur + skew rise, replays on filter change
    // =====================================================
    const products = document.querySelector('.page-products');
    if (products) {
        headings(products, { y: dist(30) });

        const split = products.querySelector('.inner-split');
        if (split) {
            singleReveal(split.children[0], { opacity: 0, y: dist(50) }, { y: 0 });
            batchReveal(all(split.children[1], 'p'), { opacity: 0, y: dist(40) }, { y: 0 }, { stagger: 0.18 });
        }

        batchReveal(all(products, '.inner-filter'), { opacity: 0, scale: 0.8, y: dist(20) }, { scale: 1, y: 0, duration: 0.7, ease: 'back.out(1.6)' }, { stagger: 0.07 });

        const cards = all(products, '.catalog-card');
        const cardFrom = (card) => ({
            opacity: 0,
            y: dist(70),
            x: card.classList.contains('catalog-card--wide') ? dist(60) : 0,
            scale: 0.96,
            skewY: isSmall() ? 0 : 4,
            filter: 'blur(12px)'
        });
        cards.forEach((card) => gsap.set(card, cardFrom(card)));
        ScrollTrigger.batch(cards, {
            start: 'top 90%',
            once: true,
            onEnter: (batch) => gsap.to(batch, { opacity: 1, y: 0, x: 0, scale: 1, skewY: 0, filter: 'blur(0px)', duration: 1.2, stagger: 0.15, ease: 'power3.out', overwrite: true, clearProps: CLEAR + ',skewY' })
        });

        // replay for the visible cards when the family filter changes
        all(products, '.inner-filter').forEach((btn) => {
            btn.addEventListener('click', () => {
                requestAnimationFrame(() => {
                    const visible = cards.filter((c) => !c.hidden);
                    gsap.fromTo(visible, cardFrom(visible[0] || document.body), { opacity: 1, y: 0, x: 0, scale: 1, skewY: 0, filter: 'blur(0px)', duration: 0.9, stagger: 0.1, ease: 'power3.out', overwrite: true, clearProps: CLEAR + ',skewY' });
                    ScrollTrigger.refresh();
                });
            });
        });

        const cta = products.querySelector('.page-cta');
        if (cta) {
            gsap.set(cta, { clipPath: 'inset(0% 8% 0% 8% round 5px)', opacity: 0, y: dist(40) });
            ScrollTrigger.create({
                trigger: cta,
                start: 'top 88%',
                once: true,
                onEnter: () => gsap.to(cta, { clipPath: 'inset(0% 0% 0% 0% round 5px)', opacity: 1, y: 0, duration: 1.3, ease: 'expo.out', clearProps: CLEAR })
            });
        }
    }

    // =====================================================
    // PRODUCT DETAIL - centre-out gallery, count-up, alternating table rows, chip pop
    // =====================================================
    const detail = document.querySelector('.page-product-detail');
    if (detail) {
        headings(detail, { y: dist(30) });

        const split = detail.querySelector('.inner-split');
        if (split) {
            singleReveal(split.children[0], { opacity: 0, x: -dist(60) }, { x: 0 });
            batchReveal(all(split.children[1], 'p'), { opacity: 0, y: dist(40) }, { y: 0 }, { stagger: 0.18 });
        }

        // gallery opens from the centre, image settles with a slow zoom
        const gallery = detail.querySelector('.pd-gallery');
        if (gallery) {
            const img = gallery.querySelector('img');
            const dots = all(gallery, '.pd-gallery-dots span');
            gsap.set(gallery, { clipPath: 'inset(20% 12% 20% 12% round 5px)' });
            gsap.set(img, { scale: 1.3 });
            gsap.set(dots, { scaleX: 0, transformOrigin: 'left center' });
            ScrollTrigger.create({
                trigger: gallery,
                start: 'top 82%',
                once: true,
                onEnter: () => {
                    gsap.to(gallery, { clipPath: 'inset(0% 0% 0% 0% round 5px)', duration: 1.5, ease: 'expo.out', clearProps: 'clipPath' });
                    gsap.to(img, { scale: 1, duration: 2, ease: 'power3.out', clearProps: 'transform' });
                    gsap.to(dots, { scaleX: 1, duration: 0.6, stagger: 0.08, delay: 0.8, ease: 'power2.out', clearProps: 'transform' });
                }
            });
        }

        // feature cards rise and their numbers count up
        const features = all(detail, '.pd-feature');
        features.forEach((card) => {
            const num = card.querySelector('.pd-feature-num');
            const target = num ? parseInt(num.textContent, 10) : 0;
            gsap.set(card, { opacity: 0, y: dist(50) });
            ScrollTrigger.create({
                trigger: card,
                start: 'top 90%',
                once: true,
                onEnter: () => {
                    gsap.to(card, { opacity: 1, y: 0, duration: 1, ease: 'power3.out', clearProps: CLEAR });
                    if (num && target) {
                        const counter = { v: 0 };
                        gsap.to(counter, {
                            v: target,
                            duration: 1.2,
                            ease: 'power2.out',
                            onUpdate: () => { num.textContent = String(Math.round(counter.v)).padStart(2, '0'); },
                            onComplete: () => { num.textContent = String(target).padStart(2, '0'); }
                        });
                    }
                }
            });
        });

        // spec table: wrapper draws in, rows alternate left / right
        const tableWrap = detail.querySelector('.pd-table-wrap');
        if (tableWrap) {
            gsap.set(tableWrap, { clipPath: 'inset(0% 100% 0% 0% round 12px)' });
            ScrollTrigger.create({
                trigger: tableWrap,
                start: 'top 85%',
                once: true,
                onEnter: () => gsap.to(tableWrap, { clipPath: 'inset(0% 0% 0% 0% round 12px)', duration: 1.2, ease: 'expo.out', clearProps: 'clipPath' })
            });
            const rows = all(tableWrap, 'tbody tr');
            rows.forEach((row, i) => gsap.set(row, { opacity: 0, x: (i % 2 === 0 ? -1 : 1) * dist(60) }));
            ScrollTrigger.create({
                trigger: tableWrap,
                start: 'top 82%',
                once: true,
                onEnter: () => gsap.to(rows, { opacity: 1, x: 0, duration: 0.9, delay: 0.3, stagger: 0.14, ease: 'power3.out', clearProps: CLEAR })
            });
        }

        // grade chips pop out from the centre
        const chips = all(detail, '.pd-grade');
        if (chips.length) {
            gsap.set(chips, { opacity: 0, scale: 0.5 });
            ScrollTrigger.create({
                trigger: chips[0],
                start: 'top 90%',
                once: true,
                onEnter: () => gsap.to(chips, { opacity: 1, scale: 1, duration: 0.7, stagger: { each: 0.05, from: 'center' }, ease: 'back.out(2)', clearProps: CLEAR })
            });
        }
        singleReveal(detail.querySelector('.pd-grades-note'), { opacity: 0, y: dist(30) }, { y: 0 });

        // industries: cards rise, label bars slide up
        const industries = all(detail, '.pd-industry');
        industries.forEach((card) => {
            const label = card.querySelector('span');
            gsap.set(card, { opacity: 0, y: dist(80) });
            if (label) gsap.set(label, { yPercent: 100 });
        });
        ScrollTrigger.batch(industries, {
            start: 'top 90%',
            once: true,
            onEnter: (batch) => {
                batch.forEach((card, i) => {
                    const label = card.querySelector('span');
                    gsap.to(card, { opacity: 1, y: 0, duration: 1.1, delay: i * 0.12, ease: 'power3.out', clearProps: CLEAR });
                    if (label) gsap.to(label, { yPercent: 0, duration: 0.8, delay: i * 0.12 + 0.5, ease: 'power3.out', clearProps: 'transform' });
                });
            }
        });
    }

    // images / fonts can change layout height after load
    window.addEventListener('load', () => ScrollTrigger.refresh());
});
