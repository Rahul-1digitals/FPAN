<?php
/**
 * Title: Member Portal CTA
 * Slug: fpan-theme/clinical-portal-cta
 * Description: Strong call-to-action banner for accessing the FPAN Member Portal. Update the Access Member Portal button href with the actual portal URL. The Contact Support button links to /contact by default.
 * Categories: fpan-healthcare, banner
 * Keywords: clinical, portal, member, login, access, cta, fpan, resources
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"anchor":"portal","backgroundColor":"navy","className":"clinical-portal-cta","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl"}}},"layout":{"type":"constrained"}} -->
<div id="portal" class="wp-block-group clinical-portal-cta has-navy-background-color has-background" style="padding-top:var(--wp--preset--spacing--2-xl);padding-bottom:var(--wp--preset--spacing--2-xl)">

<!-- wp:html -->
<div class="clinical-portal-cta__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
<!-- /wp:html -->

<!-- wp:heading {"textAlign":"center","level":2,"textColor":"white","className":"clinical-portal-cta__heading","fontSize":"2xl"} -->
<h2 class="wp-block-heading clinical-portal-cta__heading has-white-color has-text-color has-text-align-center has-2xl-font-size">Access the FPAN Member Portal</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textAlign":"center","textColor":"white","className":"clinical-portal-cta__text"} -->
<p class="clinical-portal-cta__text has-white-color has-text-color has-text-align-center">Log in to access clinical resources, quality reports, provider tools, and network communications available exclusively to FPAN members.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
<!-- wp:button {"backgroundColor":"teal","textColor":"white","className":"clinical-portal-cta__btn"} -->
<div class="wp-block-button clinical-portal-cta__btn"><a class="wp-block-button__link has-teal-background-color has-white-color has-background has-text-color wp-element-button" href="#">Access Member Portal</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"clinical-portal-cta__btn-outline"} -->
<div class="wp-block-button clinical-portal-cta__btn-outline"><a class="wp-block-button__link wp-element-button" href="/contact">Contact Support</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
