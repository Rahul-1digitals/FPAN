<?php
/**
 * Title: Find a Provider CTA Banner
 * Slug: fpan-theme/cta-find-provider
 * Description: Full-width CTA banner directing patients to the Provider Directory. Reusable across pages.
 * Categories: fpan-healthcare, banner
 * Keywords: cta, provider, find, banner, call to action, directory
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","className":"fp-cta-banner","style":{"spacing":{"padding":{"top":"var:preset|spacing|3xl","bottom":"var:preset|spacing|3xl"}},"color":{"gradient":"linear-gradient(135deg, #0D2B55 0%, #0F7B82 100%)"}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignfull fp-cta-banner" style="padding-top:var(--wp--preset--spacing--3-xl);padding-bottom:var(--wp--preset--spacing--3-xl);background:linear-gradient(135deg, #0D2B55 0%, #0F7B82 100%)">

	<!-- wp:heading {"level":2,"textColor":"white","fontSize":"3xl","textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|md"}}}} -->
	<h2 class="wp-block-heading has-white-color has-text-color has-3xl-font-size has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--md)">Ready to Find a Provider?</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"textAlign":"center","style":{"color":{"text":"rgba(255,255,255,0.85)"},"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
	<p class="has-text-color has-text-align-center" style="color:rgba(255,255,255,0.85);margin-bottom:var(--wp--preset--spacing--xl)">Search our network of 400+ pediatric specialists and primary care providers across Florida. Getting the right care for your family starts here.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|md"}}} -->
	<div class="wp-block-buttons">

		<!-- wp:button {"backgroundColor":"white","textColor":"navy","className":"is-style-fill fp-cta-banner__btn--primary","style":{"border":{"radius":"0.5rem"},"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}}} -->
		<div class="wp-block-button is-style-fill fp-cta-banner__btn--primary">
			<a class="wp-block-button__link has-navy-color has-white-background-color has-text-color has-background wp-element-button" href="/provider-directory" style="border-radius:0.5rem;padding-top:var(--wp--preset--spacing--sm);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">Find a Provider →</a>
		</div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"is-style-outline fp-cta-banner__btn--secondary","textColor":"white","style":{"border":{"radius":"0.5rem","color":"rgba(255,255,255,0.55)","width":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}}} -->
		<div class="wp-block-button is-style-outline fp-cta-banner__btn--secondary">
			<a class="wp-block-button__link has-white-color has-text-color wp-element-button" href="/specialty-care-clinics" style="border-radius:0.5rem;border-color:rgba(255,255,255,0.55);border-width:2px;padding-top:var(--wp--preset--spacing--sm);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">View Specialty Clinics</a>
		</div>
		<!-- /wp:button -->

	</div>
	<!-- /wp:buttons -->

</div>
<!-- /wp:group -->
