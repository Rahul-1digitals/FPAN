<?php
/**
 * Title: Clinical Video Grid
 * Slug: fpan-theme/clinical-video-grid
 * Description: Two-column Vimeo embed section for clinical training and educational videos. Replace the placeholder Vimeo URLs with real video IDs. Update video titles and descriptions for each entry. Insert a second instance to add more rows of videos.
 * Categories: fpan-healthcare
 * Keywords: clinical, video, vimeo, training, education, embed, healthcare, media
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"anchor":"videos","className":"fp-clinical-section clinical-video-section","layout":{"type":"constrained"}} -->
<div id="videos" class="wp-block-group fp-clinical-section clinical-video-section">

<!-- wp:paragraph {"textColor":"teal","className":"fp-clinical-section__eyebrow"} -->
<p class="fp-clinical-section__eyebrow has-teal-color has-text-color">Training</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"textColor":"navy","className":"fp-clinical-section__heading"} -->
<h2 class="wp-block-heading fp-clinical-section__heading has-navy-color has-text-color">Educational Videos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"fp-clinical-section__intro"} -->
<p class="fp-clinical-section__intro">On-demand training videos and clinical education content for FPAN network providers and staff. Replace placeholder URLs with your Vimeo video IDs before publishing.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"clinical-video-grid","layout":{"type":"default"}} -->
<div class="wp-block-group clinical-video-grid">

<!-- wp:group {"className":"clinical-video-item","layout":{"type":"constrained"}} -->
<div class="wp-block-group clinical-video-item">
<!-- wp:embed {"url":"https://vimeo.com/123456789","type":"video","providerNameSlug":"vimeo","responsive":true,"className":"clinical-video-embed"} -->
<figure class="wp-block-embed is-type-video is-provider-vimeo wp-block-embed-vimeo clinical-video-embed"><div class="wp-block-embed__wrapper">
https://vimeo.com/123456789
</div></figure>
<!-- /wp:embed -->
<!-- wp:heading {"level":3,"textColor":"navy","className":"clinical-video-item__title"} -->
<h3 class="wp-block-heading clinical-video-item__title has-navy-color has-text-color">Video Title</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"clinical-video-item__desc"} -->
<p class="clinical-video-item__desc">Brief description of this training video&#8217;s content, learning objectives, and intended provider audience.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"clinical-video-item","layout":{"type":"constrained"}} -->
<div class="wp-block-group clinical-video-item">
<!-- wp:embed {"url":"https://vimeo.com/987654321","type":"video","providerNameSlug":"vimeo","responsive":true,"className":"clinical-video-embed"} -->
<figure class="wp-block-embed is-type-video is-provider-vimeo wp-block-embed-vimeo clinical-video-embed"><div class="wp-block-embed__wrapper">
https://vimeo.com/987654321
</div></figure>
<!-- /wp:embed -->
<!-- wp:heading {"level":3,"textColor":"navy","className":"clinical-video-item__title"} -->
<h3 class="wp-block-heading clinical-video-item__title has-navy-color has-text-color">Video Title</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"clinical-video-item__desc"} -->
<p class="clinical-video-item__desc">Brief description of this training video&#8217;s content, learning objectives, and intended provider audience.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->
