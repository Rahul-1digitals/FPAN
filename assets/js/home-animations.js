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

    // Inject icons into each stat card
    (function injectStatIcons() {
        var icons = [
            // Network providers — org-chart hierarchy
            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="8" y="1" width="8" height="5" rx="1.2"/><rect x="1" y="17" width="6" height="5" rx="1.2"/><rect x="9" y="17" width="6" height="5" rx="1.2"/><rect x="17" y="17" width="6" height="5" rx="1.2"/><path d="M12 6v5M4 17v-3h16v3"/></svg>',
            // Patients served — two people
            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
            // Florida counties — map pin
            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
            // Years of excellence — award ribbon
            '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>'
        ];
        var cols = document.querySelectorAll('.home-stat-col');
        cols.forEach(function (col, i) {
            if (col.querySelector('.home-stat__icon')) return; // already injected
            var span = document.createElement('span');
            span.className = 'home-stat__icon';
            span.innerHTML = icons[i] || icons[0];
            col.insertBefore(span, col.firstChild);
        });
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
