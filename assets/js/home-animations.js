(function () {
    'use strict';

    var SELECTORS = [
        '[data-animate]',
        '.home-quick-access__grid',
        '.home-stats-grid',
        '.home-audience-cards',
        '.home-resource-cards'
    ].join(', ');

    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll(SELECTORS).forEach(function (el) {
            el.classList.add('is-visible');
        });
        return;
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll(SELECTORS).forEach(function (el) {
        observer.observe(el);
    });
}());
