<?php
/**
 * Title: Clinical Audience Resource Section
 * Slug: fpan-theme/clinical-audience-section
 * Description: A resource card grid for a specific provider audience. Pre-populated for Physicians with 4 resource cards. After inserting: (1) set anchor ID in Block Inspector > Advanced (e.g. physicians, apps, clinic-staff, care-coordinators, quality-teams), (2) update the heading and description, (3) replace card titles, descriptions, and links.
 * Categories: fpan-healthcare
 * Keywords: clinical, resources, audience, physicians, APPs, clinic staff, cards, grid, hub
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"anchor":"physicians","className":"fp-clinical-section clinical-audience-section","layout":{"type":"constrained"}} -->
<div id="physicians" class="wp-block-group fp-clinical-section clinical-audience-section">

<!-- wp:heading {"level":2,"textColor":"navy","className":"fp-clinical-section__heading"} -->
<h2 class="wp-block-heading fp-clinical-section__heading has-navy-color has-text-color">Physicians</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"fp-clinical-section__intro"} -->
<p class="fp-clinical-section__intro">Clinical guidelines, coding references, CME materials, and referral resources for FPAN network physicians.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"clinical-resource-cards","layout":{"type":"default"}} -->
<div class="wp-block-group clinical-resource-cards">

<!-- wp:group {"className":"clinical-resource-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group clinical-resource-card">
<!-- wp:html -->
<div class="clinical-resource-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div>
<!-- /wp:html -->
<!-- wp:heading {"level":3,"textColor":"navy","className":"clinical-resource-card__title"} -->
<h3 class="wp-block-heading clinical-resource-card__title has-navy-color has-text-color">Clinical Guidelines</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"clinical-resource-card__desc"} -->
<p class="clinical-resource-card__desc">Network clinical guidelines and evidence-based protocols for care delivery within the FPAN system.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"clinical-resource-card__link"} -->
<p class="clinical-resource-card__link"><a href="#">View Guidelines &#8594;</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"clinical-resource-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group clinical-resource-card">
<!-- wp:html -->
<div class="clinical-resource-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
<!-- /wp:html -->
<!-- wp:heading {"level":3,"textColor":"navy","className":"clinical-resource-card__title"} -->
<h3 class="wp-block-heading clinical-resource-card__title has-navy-color has-text-color">Referral Process</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"clinical-resource-card__desc"} -->
<p class="clinical-resource-card__desc">Step-by-step guidance for referring patients within the FPAN network and to M Health Fairview specialists.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"clinical-resource-card__link"} -->
<p class="clinical-resource-card__link"><a href="#">View Referral Info &#8594;</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"clinical-resource-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group clinical-resource-card">
<!-- wp:html -->
<div class="clinical-resource-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></div>
<!-- /wp:html -->
<!-- wp:heading {"level":3,"textColor":"navy","className":"clinical-resource-card__title"} -->
<h3 class="wp-block-heading clinical-resource-card__title has-navy-color has-text-color">Coding Resources</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"clinical-resource-card__desc"} -->
<p class="clinical-resource-card__desc">ICD-10 and CPT coding references and billing guidance specific to FPAN network clinical workflows.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"clinical-resource-card__link"} -->
<p class="clinical-resource-card__link"><a href="#">View Coding Resources &#8594;</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"clinical-resource-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group clinical-resource-card">
<!-- wp:html -->
<div class="clinical-resource-card__icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg></div>
<!-- /wp:html -->
<!-- wp:heading {"level":3,"textColor":"navy","className":"clinical-resource-card__title"} -->
<h3 class="wp-block-heading clinical-resource-card__title has-navy-color has-text-color">CME Materials</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"clinical-resource-card__desc"} -->
<p class="clinical-resource-card__desc">Continuing medical education resources, approved learning modules, and compliance tracking materials.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"clinical-resource-card__link"} -->
<p class="clinical-resource-card__link"><a href="#">View CME Resources &#8594;</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->
