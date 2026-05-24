<?php
/**
 * Title: Homepage Hero
 * Slug: fpan-theme/home-hero
 * Description: Full-width hero section with eyebrow text, heading, subheading, and two CTA buttons. Designed for the FPAN healthcare homepage.
 * Categories: fpan-healthcare, banner
 * Keywords: hero, healthcare, banner, cover, cta, homepage
 * Viewport Width: 1280
 * Block Types: core/cover
 */
?>

<!-- wp:cover {"dimRatio":70,"overlayColor":"navy-dark","isUserOverlayColor":true,"minHeight":580,"minHeightUnit":"px","align":"full","className":"home-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull home-hero" style="min-height:580px">
	<span aria-hidden="true" class="wp-block-cover__background has-navy-dark-background-color has-background-dim-70 has-background-dim"></span>
	<div class="wp-block-cover__inner-container is-layout-constrained">

		<!-- wp:group {"className":"home-hero__content","style":{"spacing":{"blockGap":"var:preset|spacing|lg","padding":{"top":"var:preset|spacing|4xl","bottom":"var:preset|spacing|4xl"}}},"layout":{"type":"constrained","contentSize":"680px","justifyContent":"left"}} -->
		<div class="wp-block-group home-hero__content" style="padding-top:var(--wp--preset--spacing--4xl);padding-bottom:var(--wp--preset--spacing--4xl)">

			<!-- wp:paragraph {"className":"home-hero__eyebrow","textColor":"teal-light","fontSize":"sm","style":{"typography":{"fontWeight":"600","letterSpacing":"0.08em","textTransform":"uppercase"}}} -->
			<p class="home-hero__eyebrow has-teal-light-color has-text-color has-sm-font-size" style="font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Florida's Premier Pediatric Network</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1,"textColor":"white","fontSize":"4xl","className":"home-hero__heading","style":{"typography":{"lineHeight":"1.15"}}} -->
			<h1 class="wp-block-heading home-hero__heading has-white-color has-text-color has-4-xl-font-size" style="line-height:1.15">Advancing Pediatric Care Across Florida</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"white","className":"home-hero__subheading","fontSize":"md","style":{"color":{"text":"rgba(255,255,255,0.85)"}}} -->
			<p class="home-hero__subheading has-text-color has-md-font-size" style="color:rgba(255,255,255,0.85)">FPAN is a clinically integrated network connecting pediatric practices to improve outcomes, reduce costs, and advance value-based care.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"className":"home-hero__actions","style":{"spacing":{"blockGap":"var:preset|spacing|md","margin":{"top":"var:preset|spacing|xl"}}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
			<div class="wp-block-buttons home-hero__actions" style="margin-top:var(--wp--preset--spacing--xl)">

				<!-- wp:button {"backgroundColor":"teal","textColor":"white","className":"is-style-fill home-hero__btn--primary","style":{"border":{"radius":"0.5rem"},"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}}} -->
				<div class="wp-block-button is-style-fill home-hero__btn--primary">
					<a class="wp-block-button__link has-white-color has-teal-background-color has-text-color has-background wp-element-button" href="/join-fpan" style="border-radius:0.5rem;padding-top:var(--wp--preset--spacing--sm);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">Join FPAN</a>
				</div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline home-hero__btn--secondary","textColor":"white","style":{"border":{"radius":"0.5rem","color":"rgba(255,255,255,0.6)","width":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}}} -->
				<div class="wp-block-button is-style-outline home-hero__btn--secondary">
					<a class="wp-block-button__link has-white-color has-text-color wp-element-button" href="/about-fpan" style="border-radius:0.5rem;border-color:rgba(255,255,255,0.6);border-width:2px;padding-top:var(--wp--preset--spacing--sm);padding-bottom:var(--wp--preset--spacing--sm);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">Learn More</a>
				</div>
				<!-- /wp:button -->

			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:group -->

	</div>
</div>
<!-- /wp:cover -->
