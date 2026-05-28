(function () {
    'use strict';

    // Inject ambient orbs + light beams into the hero for independent CSS animation
    (function injectHeroLayers() {
        var hero = document.querySelector('.front-page-hero');
        if (!hero) return;
        hero.insertAdjacentHTML('afterbegin',
            '<div class="hero-orb hero-orb--1" aria-hidden="true"></div>' +
            '<div class="hero-orb hero-orb--2" aria-hidden="true"></div>' +
            '<div class="hero-orb hero-orb--3" aria-hidden="true"></div>' +
            '<div class="hero-orb hero-orb--4" aria-hidden="true"></div>' +
            '<div class="hero-orb hero-orb--5" aria-hidden="true"></div>' +
            '<div class="hero-beam hero-beam--1" aria-hidden="true"></div>' +
            '<div class="hero-beam hero-beam--2" aria-hidden="true"></div>' +
            '<div class="hero-beam hero-beam--3" aria-hidden="true"></div>'
        );
    }());

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
