document.addEventListener('DOMContentLoaded', () => {
    // Mark body so CSS knows JS loaded — enables reveal animation hiding.
    // Without this class, all .reveal content stays fully visible.
    document.body.classList.add('js-reveal');

    initBrandLogo();
    initScrollReveal();
    initHeaderScroll();
    initCounters();
    initStaggerChildren();
});

// 0. Brand Logo visibility is handled purely by PHP server-side inclusion varying the DOM.
// No client-side toggle needed.

// 1. Scroll Reveal (Intersection Observer)
function initScrollReveal() {
    const options = {
        threshold: 0,
        rootMargin: '0px 0px 0px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, options);

    document.querySelectorAll('.reveal').forEach(el => {
        // Immediately activate elements already in the viewport on page load
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            el.classList.add('active');
        } else {
            observer.observe(el);
        }
    });
}

// 2. Header Scroll Effect
function initHeaderScroll() {
    const header = document.querySelector('header');
    if (!header) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });
}

// 3. Stagger Children Helper
function initStaggerChildren() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0 });

    document.querySelectorAll('.stagger-children').forEach(el => {
        // Immediately activate grids already in the viewport
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            el.classList.add('active');
        } else {
            observer.observe(el);
        }
    });
}

// 4. Number Counters
function initCounters() {
    const counters = document.querySelectorAll('.counter-value');
    if (counters.length === 0) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.target);
                if (!isNaN(target)) {
                    animateCount(el, target);
                }
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
}

function animateCount(el, target) {
    let startTimestamp = null;
    const duration = 2000; // 2 seconds

    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);

        // Ease out quart
        const easeProgress = 1 - Math.pow(1 - progress, 4);

        el.innerText = Math.floor(easeProgress * target);

        if (progress < 1) {
            window.requestAnimationFrame(step);
        } else {
            el.innerText = target; // Ensure exact end
        }
    };

    window.requestAnimationFrame(step);
}
