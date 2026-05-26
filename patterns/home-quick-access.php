<?php
/**
 * Title: Homepage Quick Access Tiles
 * Slug: fpan-theme/home-quick-access
 * Description: Six quick-access cards using native Gutenberg blocks. Edit icon, label, and link for each tile directly in the editor.
 * Categories: fpan-healthcare
 * Keywords: homepage, quick access, tiles, navigation, links
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","className":"home-quick-access","style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull home-quick-access is-layout-constrained wp-block-group-is-layout-constrained" style="padding-top:var(--wp--preset--spacing--3-xl);padding-bottom:var(--wp--preset--spacing--3-xl)">

<!-- wp:paragraph {"textAlign":"center","textColor":"teal","className":"home-qa__eyebrow"} -->
<p class="home-qa__eyebrow has-teal-color has-text-color has-text-align-center">Quick Access</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"textColor":"navy","className":"home-qa__heading"} -->
<h2 class="wp-block-heading home-qa__heading has-navy-color has-text-color has-text-align-center">Everything You Need, In One Place</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textAlign":"center","className":"home-qa__intro"} -->
<p class="home-qa__intro has-text-align-center">Access provider tools, patient resources, clinical education, and member services — all from one central hub.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"home-quick-access__grid"} -->
<div class="wp-block-group home-quick-access__grid">

<!-- wp:group {"className":"home-qa-card"} -->
<div class="wp-block-group home-qa-card">
<!-- wp:html -->
<span class="home-qa-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
<!-- /wp:html -->
<!-- wp:paragraph {"className":"home-qa-card__label"} -->
<p class="home-qa-card__label">Find a Provider</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"home-qa-card__link-btn"} -->
<div class="wp-block-button home-qa-card__link-btn"><a class="wp-block-button__link wp-element-button" href="/provider-directory/">Find a Provider</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"home-qa-card"} -->
<div class="wp-block-group home-qa-card">
<!-- wp:html -->
<span class="home-qa-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
<!-- /wp:html -->
<!-- wp:paragraph {"className":"home-qa-card__label"} -->
<p class="home-qa-card__label">Member Portal</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"home-qa-card__link-btn"} -->
<div class="wp-block-button home-qa-card__link-btn"><a class="wp-block-button__link wp-element-button" href="#">Member Portal</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"home-qa-card"} -->
<div class="wp-block-group home-qa-card">
<!-- wp:html -->
<span class="home-qa-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span>
<!-- /wp:html -->
<!-- wp:paragraph {"className":"home-qa-card__label"} -->
<p class="home-qa-card__label">Clinical Resources</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"home-qa-card__link-btn"} -->
<div class="wp-block-button home-qa-card__link-btn"><a class="wp-block-button__link wp-element-button" href="/clinical-resources/">Clinical Resources</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"home-qa-card"} -->
<div class="wp-block-group home-qa-card">
<!-- wp:html -->
<span class="home-qa-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
<!-- /wp:html -->
<!-- wp:paragraph {"className":"home-qa-card__label"} -->
<p class="home-qa-card__label">Membership</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"home-qa-card__link-btn"} -->
<div class="wp-block-button home-qa-card__link-btn"><a class="wp-block-button__link wp-element-button" href="/membership/">Membership</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"home-qa-card"} -->
<div class="wp-block-group home-qa-card">
<!-- wp:html -->
<span class="home-qa-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.5 2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.86a16 16 0 0 0 6.13 6.13l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
<!-- /wp:html -->
<!-- wp:paragraph {"className":"home-qa-card__label"} -->
<p class="home-qa-card__label">For Patients</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"home-qa-card__link-btn"} -->
<div class="wp-block-button home-qa-card__link-btn"><a class="wp-block-button__link wp-element-button" href="/for-patients/">For Patients</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"home-qa-card"} -->
<div class="wp-block-group home-qa-card">
<!-- wp:html -->
<span class="home-qa-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
<!-- /wp:html -->
<!-- wp:paragraph {"className":"home-qa-card__label"} -->
<p class="home-qa-card__label">Contact Us</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"home-qa-card__link-btn"} -->
<div class="wp-block-button home-qa-card__link-btn"><a class="wp-block-button__link wp-element-button" href="/contact/">Contact Us</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->
