document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
    initHeaderScroll();
    initCounters();
    initStaggerChildren();
});

// 1. Scroll Reveal (Intersection Observer)
function initScrollReveal() {
    const options = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                // Optional: unobserve if you only want it to animate once
                observer.unobserve(entry.target);
            }
        });
    }, options);

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
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
    }, { threshold: 0.1 });

    document.querySelectorAll('.stagger-children').forEach(el => observer.observe(el));
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
