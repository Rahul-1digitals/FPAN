<?php
/**
 * Title: Membership Content Section
 * Slug: fpan-theme/membership-content-section
 * Description: A reusable content section with heading, description, and bullet list. Use once per topic on the Member Responsibilities and Quality Improvement pages. After inserting: (1) update the heading, (2) set the anchor ID in Block Inspector > Advanced, (3) replace placeholder list items.
 * Categories: fpan-healthcare
 * Keywords: membership, section, content, responsibilities, quality, list, heading
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"anchor":"section-id","className":"fp-membership-section","layout":{"type":"constrained"}} -->
<div id="section-id" class="wp-block-group fp-membership-section">

<!-- wp:heading {"level":2,"textColor":"navy","className":"fp-membership-section__heading"} -->
<h2 class="wp-block-heading fp-membership-section__heading has-navy-color has-text-color">Section Heading</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"fp-membership-section__intro"} -->
<p class="fp-membership-section__intro">Add a brief description of this section&#8217;s purpose and scope. Replace this placeholder text with the actual content for this topic area.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"fp-membership-list"} -->
<ul class="wp-block-list fp-membership-list">
<!-- wp:list-item -->
<li>Key expectation or requirement</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Key expectation or requirement</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Key expectation or requirement</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Key expectation or requirement</li>
<!-- /wp:list-item -->
</ul>
<!-- /wp:list -->

</div>
<!-- /wp:group -->
