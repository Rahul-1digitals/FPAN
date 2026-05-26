<?php
/**
 * Title: Clinical Resources Jump Navigation
 * Slug: fpan-theme/clinical-resources-jump-nav
 * Description: Horizontal anchor-link navigation bar for jumping to Clinical Resources Hub sections. Add or remove links as sections change. No JavaScript required.
 * Categories: fpan-healthcare
 * Keywords: clinical, resources, jump nav, anchor, navigation, links, hub
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"className":"clinical-jump-nav","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|2xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group clinical-jump-nav" style="margin-bottom:var(--wp--preset--spacing--2-xl)">

<!-- wp:html -->
<nav class="clinical-jump-nav__inner" aria-label="Jump to clinical resource section">
	<span class="clinical-jump-nav__label">Jump to:</span>
	<a href="#physicians" class="clinical-jump-nav__link">Physicians</a>
	<a href="#apps" class="clinical-jump-nav__link">APPs</a>
	<a href="#clinic-staff" class="clinical-jump-nav__link">Clinic Staff</a>
	<a href="#asthma-diabetes" class="clinical-jump-nav__link">Asthma &amp; Diabetes</a>
	<a href="#videos" class="clinical-jump-nav__link">Videos</a>
	<a href="#downloads" class="clinical-jump-nav__link">Downloads</a>
	<a href="#portal" class="clinical-jump-nav__link">Member Portal</a>
</nav>
<!-- /wp:html -->

</div>
<!-- /wp:group -->
