<?php
/**
 * Title: Homepage Featured Resources
 * Slug: fpan-theme/home-resources-strip
 * Description: Three static featured resource cards for Clinical Resources Hub, Membership Benefits, and ACO REACH Program. Update hrefs and descriptions as needed.
 * Categories: fpan-healthcare
 * Keywords: homepage, resources, featured, cards, clinical, membership
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","className":"home-resources-strip","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull home-resources-strip is-layout-constrained wp-block-group-is-layout-constrained" style="padding-top:var(--wp--preset--spacing--2-xl);padding-bottom:var(--wp--preset--spacing--2-xl)">

<!-- wp:paragraph {"textColor":"teal","className":"home-section__eyebrow"} -->
<p class="home-section__eyebrow has-teal-color has-text-color">Resources</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"textColor":"navy","className":"home-section__heading"} -->
<h2 class="wp-block-heading home-section__heading has-navy-color has-text-color">Key Resources for Our Network</h2>
<!-- /wp:heading -->

<!-- wp:html -->
<div class="home-resource-cards" data-animate>
  <a class="home-resource-card" href="/clinical-resources/">
    <span class="home-resource-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span>
    <span class="home-resource-card__cat">For Providers</span>
    <span class="home-resource-card__title">Clinical Resources Hub</span>
    <span class="home-resource-card__desc">Guidelines, education materials, training videos, and downloadable forms for FPAN network providers.</span>
    <span class="home-resource-card__link">Access Resources &rarr;</span>
  </a>
  <a class="home-resource-card" href="/membership/">
    <span class="home-resource-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
    <span class="home-resource-card__cat">Network</span>
    <span class="home-resource-card__title">Membership Benefits</span>
    <span class="home-resource-card__desc">Discover the clinical, financial, and operational benefits of joining the FPAN network.</span>
    <span class="home-resource-card__link">Learn More &rarr;</span>
  </a>
  <a class="home-resource-card" href="/aco-reach/">
    <span class="home-resource-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></span>
    <span class="home-resource-card__cat">Compliance</span>
    <span class="home-resource-card__title">ACO REACH Program</span>
    <span class="home-resource-card__desc">Learn about FPAN&#8217;s Accountable Care Organization participation, metrics, and provider information.</span>
    <span class="home-resource-card__link">View ACO REACH &rarr;</span>
  </a>
</div>
<!-- /wp:html -->

</div>
<!-- /wp:group -->
