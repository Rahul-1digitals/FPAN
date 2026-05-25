<?php
/**
 * Title: Committee Member Entry
 * Slug: fpan-theme/committee-member
 * Description: A single committee member entry with name, role, and optional organization. Insert inside a Committee Section's member grid to add additional members.
 * Categories: fpan-healthcare
 * Keywords: committee, member, governance, person, name, role, board
 * Viewport Width: 600
 */
?>

<!-- wp:group {"className":"committee-member-entry","layout":{"type":"constrained"}} -->
<div class="wp-block-group committee-member-entry">

<!-- wp:heading {"level":3,"textColor":"navy","className":"committee-member__name"} -->
<h3 class="wp-block-heading committee-member__name has-navy-color has-text-color">Member Name</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"teal","className":"committee-member__role"} -->
<p class="committee-member__role has-teal-color has-text-color">Title / Role, Organization</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->
