<?php
/**
 * Title: Membership Navigation Cards
 * Slug: fpan-theme/membership-nav-cards
 * Description: Two-column related page navigation cards for the Membership section. Pre-populated with links to Member Responsibilities and Quality Improvement. Update the heading, descriptions, and hrefs per page (e.g. swap one card for the Membership parent when used on a child page).
 * Categories: fpan-healthcare
 * Keywords: membership, navigation, related, also see, cards, links, explore
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"className":"fp-membership-section membership-nav-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group fp-membership-section membership-nav-section">

<!-- wp:heading {"level":2,"textColor":"navy","className":"fp-membership-section__heading"} -->
<h2 class="wp-block-heading fp-membership-section__heading has-navy-color has-text-color">Also See</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"membership-nav-cards","layout":{"type":"default"}} -->
<div class="wp-block-group membership-nav-cards">

<!-- wp:group {"className":"membership-nav-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group membership-nav-card">
<!-- wp:html -->
<div class="membership-nav-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
<!-- /wp:html -->
<!-- wp:heading {"level":3,"textColor":"navy","className":"membership-nav-card__title"} -->
<h3 class="wp-block-heading membership-nav-card__title has-navy-color has-text-color">Member Responsibilities</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"membership-nav-card__desc"} -->
<p class="membership-nav-card__desc">Review the clinical performance expectations, quality assessment requirements, and compliance obligations for FPAN network members.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"membership-nav-card__link"} -->
<p class="membership-nav-card__link"><a href="/membership/member-responsibilities">View Member Responsibilities &#8594;</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"membership-nav-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group membership-nav-card">
<!-- wp:html -->
<div class="membership-nav-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg></div>
<!-- /wp:html -->
<!-- wp:heading {"level":3,"textColor":"navy","className":"membership-nav-card__title"} -->
<h3 class="wp-block-heading membership-nav-card__title has-navy-color has-text-color">Quality Improvement</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"membership-nav-card__desc"} -->
<p class="membership-nav-card__desc">Explore FPAN&#8217;s value-based care initiatives, quality reporting programs, and measurement frameworks for continuous improvement.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"membership-nav-card__link"} -->
<p class="membership-nav-card__link"><a href="/membership/quality-improvement">View Quality Improvement &#8594;</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->
