<?php
/**
 * Title: Governance Jump Navigation
 * Slug: fpan-theme/governance-jump-nav
 * Description: Horizontal pill-link navigation bar for jumping to each committee section on the Governance page. Uses anchor links — no JavaScript required.
 * Categories: fpan-healthcare
 * Keywords: jump nav, anchor, navigation, committees, governance, links
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"className":"governance-jump-nav","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|2xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group governance-jump-nav" style="margin-bottom:var(--wp--preset--spacing--2-xl)">

<!-- wp:html -->
<nav class="governance-jump-nav__inner" aria-label="Jump to committee section">
	<span class="governance-jump-nav__label">Jump to:</span>
	<a href="#cdqi" class="governance-jump-nav__link">Care Delivery &amp; QI</a>
	<a href="#clinic-admin" class="governance-jump-nav__link">Clinic Admin Council</a>
	<a href="#finance" class="governance-jump-nav__link">Finance</a>
	<a href="#membership" class="governance-jump-nav__link">Membership &amp; Credentials</a>
	<a href="#product-dev" class="governance-jump-nav__link">Product Development</a>
</nav>
<!-- /wp:html -->

</div>
<!-- /wp:group -->
