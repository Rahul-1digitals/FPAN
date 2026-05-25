<?php
/**
 * Title: Staff Card
 * Slug: fpan-theme/staff-card
 * Description: A single staff profile card with circular photo placeholder, name, and title/role. Insert inside an existing Staff Section grid to add more team members. Replace placeholder content with real staff details.
 * Categories: fpan-healthcare
 * Keywords: staff, card, profile, headshot, team member, person
 * Viewport Width: 400
 */
?>

<!-- wp:group {"className":"staff-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group staff-card">

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"staff-card__photo"} -->
<figure class="wp-block-image size-full staff-card__photo"><img src="https://placehold.co/112x112/dde6f0/5a7ba0" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"textColor":"navy","className":"staff-card__name"} -->
<h3 class="wp-block-heading staff-card__name has-navy-color has-text-color">Staff Member Name</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"teal","className":"staff-card__title"} -->
<p class="staff-card__title has-teal-color has-text-color">Title / Role</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"text-muted","className":"staff-card__dept"} -->
<p class="staff-card__dept has-text-muted-color has-text-color">Department (optional)</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->
