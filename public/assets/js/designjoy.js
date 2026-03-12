/**
 * designjoy.js — replaces all Webflow JS
 */

document.addEventListener('DOMContentLoaded', function () {

    // ─────────────────────────────────────────────────────────────
    // 1. LOTTIE ANIMATIONS
    // ─────────────────────────────────────────────────────────────
    document.querySelectorAll('[data-animation-type="lottie"]').forEach(function (el) {
        var src = el.getAttribute('data-src');
        var loop = el.getAttribute('data-loop') === '1';
        var autoplay = el.getAttribute('data-autoplay') === '1';
        var dir = parseInt(el.getAttribute('data-direction') || '1');
        var renderer = el.getAttribute('data-renderer') || 'svg';

        if (!src) return;

        var anim = lottie.loadAnimation({
            container: el,
            renderer: renderer,
            loop: loop,
            autoplay: autoplay,
            path: src,
        });

        anim.setDirection(dir);

        // lottie-animation-4 = logo (hover triggers play/reverse)
        if (el.classList.contains('lottie-animation-4')) {
            var parent = el.closest('.hero__logo-block') || el.parentElement;
            if (parent) {
                parent.addEventListener('mouseenter', function () {
                    anim.setDirection(1);
                    anim.play();
                });
                parent.addEventListener('mouseleave', function () {
                    anim.setDirection(-1);
                    anim.play();
                });
            }
        }

        // lottie-animation-5 = spinning badge (autoplay + loop already set via attributes)
        // nothing extra needed
    });


    // ─────────────────────────────────────────────────────────────
    // 2. SCROLL ANIMATIONS
    // Only animate elements that are BELOW the fold on load.
    // Elements already visible should appear immediately.
    // ─────────────────────────────────────────────────────────────
    var scrollEls = Array.from(document.querySelectorAll('[data-w-id]')).filter(function (el) {
        // Skip lottie containers
        if (el.hasAttribute('data-animation-type')) return false;
        // Skip elements already above the fold
        var rect = el.getBoundingClientRect();
        return rect.top > window.innerHeight;
    });

    // Set initial hidden state only on below-fold elements
    scrollEls.forEach(function (el) {
        el.style.opacity = '0';
        el.style.transform = 'translate3d(0, 24px, 0)';
        el.style.willChange = 'opacity, transform';
    });

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.style.transition = 'opacity 0.55s ease, transform 0.55s ease';
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translate3d(0, 0, 0)';
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -30px 0px'
    });

    scrollEls.forEach(function (el) { observer.observe(el); });


    // ─────────────────────────────────────────────────────────────
    // 3. FAQ ACCORDION
    // ─────────────────────────────────────────────────────────────
    var faqRows = document.querySelectorAll('.faq__row');

    // Detect the real class names from the first row
    var sampleAnswer = faqRows[0] && faqRows[0].querySelector('[class*="answer"], [class*="body"], [class*="content"]');
    var sampleArrow = faqRows[0] && faqRows[0].querySelector('[class*="arrow"], [class*="icon"], [class*="plus"]');

    faqRows.forEach(function (row) {
        // Find answer + arrow elements by partial class match
        var answer = row.querySelector('[class*="answer"], [class*="body"], [class*="faq-body"]');
        var arrow = row.querySelector('[class*="arrow"], [class*="icon"], [class*="plus"]');

        // Initial state: closed
        if (answer) {
            answer.style.display = 'none';
        }
        if (arrow) {
            arrow.style.transition = 'transform 0.3s ease';
        }

        // Clickable area — the question/header part
        var trigger = row.querySelector('[class*="question"], [class*="top"], [class*="header"]') || row;
        trigger.style.cursor = 'pointer';

        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            var isOpen = row.classList.contains('faq--open');

            // Close all rows
            faqRows.forEach(function (r) {
                var a = r.querySelector('[class*="answer"], [class*="body"], [class*="faq-body"]');
                var ar = r.querySelector('[class*="arrow"], [class*="icon"], [class*="plus"]');
                if (a) a.style.display = 'none';
                if (ar) ar.style.transform = 'rotate(0deg)';
                r.classList.remove('faq--open');
            });

            // Open this one if it was closed
            if (!isOpen) {
                if (answer) answer.style.display = 'block';
                if (arrow) arrow.style.transform = 'rotate(45deg)'; // +45 for plus→x, use 180 for chevron
                row.classList.add('faq--open');
            }
        });
    });


    // ─────────────────────────────────────────────────────────────
    // 4. MOBILE SLIDER (Swiper)
    // ─────────────────────────────────────────────────────────────
    if (typeof Swiper !== 'undefined') {
        var sliderEl = document.querySelector('.slider-resource');
        if (sliderEl) {
            var mask = sliderEl.querySelector('.mask-blog');
            var slides = sliderEl.querySelectorAll('.blog-item');
            var prev = sliderEl.querySelector('.left-arrow-2');
            var next = sliderEl.querySelector('.right-arrow-2');
            var nav = sliderEl.querySelector('.slide-nav');

            if (mask) mask.classList.add('swiper-wrapper');
            slides.forEach(function (s) { s.classList.add('swiper-slide'); });
            if (nav) nav.classList.add('swiper-pagination');

            new Swiper(sliderEl, {
                slidesPerView: 1,
                spaceBetween: 16,
                navigation: { prevEl: prev, nextEl: next },
                pagination: { el: nav, clickable: true },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    992: { slidesPerView: 3 },
                }
            });
        }
    }

});