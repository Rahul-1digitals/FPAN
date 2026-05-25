<?php
/**
 * Title: Membership Apply CTA
 * Slug: fpan-theme/membership-apply-cta
 * Description: Call-to-action banner for joining or contacting FPAN about membership. Used on all three Membership section pages. Update the button href to point to the contact or application page.
 * Categories: fpan-healthcare, banner
 * Keywords: membership, apply, join, cta, contact, network, fpan
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"backgroundColor":"navy","className":"membership-apply-cta","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group membership-apply-cta has-navy-background-color has-background" style="padding-top:var(--wp--preset--spacing--2-xl);padding-bottom:var(--wp--preset--spacing--2-xl)">

<!-- wp:heading {"textAlign":"center","level":2,"textColor":"white","className":"membership-apply-cta__heading","fontSize":"2xl"} -->
<h2 class="wp-block-heading membership-apply-cta__heading has-white-color has-text-color has-text-align-center has-2xl-font-size">Ready to Join the FPAN Network?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textAlign":"center","textColor":"white","className":"membership-apply-cta__text"} -->
<p class="membership-apply-cta__text has-white-color has-text-color has-text-align-center">Contact us to learn how participating in our network can benefit your practice and the patients you serve.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
<!-- wp:button {"backgroundColor":"teal","textColor":"white","className":"membership-apply-cta__btn"} -->
<div class="wp-block-button membership-apply-cta__btn"><a class="wp-block-button__link has-teal-background-color has-white-color has-background has-text-color wp-element-button" href="/contact">Apply to Join</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
