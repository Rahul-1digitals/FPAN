<?php
/**
 * Title: Homepage News Strip
 * Slug: fpan-theme/home-news-strip
 * Description: Three-column dynamic news card grid using wp:query to pull the latest three posts. Includes section header with View All link.
 * Categories: fpan-healthcare
 * Keywords: homepage, news, latest posts, query, blog, updates
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","className":"home-news-strip","style":{"spacing":{"padding":{"top":"var:preset|spacing|2xl","bottom":"var:preset|spacing|2xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull home-news-strip is-layout-constrained wp-block-group-is-layout-constrained" style="padding-top:var(--wp--preset--spacing--2-xl);padding-bottom:var(--wp--preset--spacing--2-xl)">

<!-- wp:group {"className":"home-news-strip__header"} -->
<div class="wp-block-group home-news-strip__header">
<!-- wp:paragraph {"textColor":"teal","className":"home-section__eyebrow"} -->
<p class="home-section__eyebrow has-teal-color has-text-color">Latest News</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"home-news-strip__view-all"} -->
<p class="home-news-strip__view-all"><a href="/news/">View All News &rarr;</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:heading {"level":2,"textColor":"navy","className":"home-section__heading"} -->
<h2 class="wp-block-heading home-section__heading has-navy-color has-text-color">News &amp; Updates</h2>
<!-- /wp:heading -->

<!-- wp:query {"queryId":21,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"home-news-query"} -->
<div class="wp-block-query home-news-query">

<!-- wp:post-template {"layout":{"type":"grid","columnCount":3},"className":"home-news-grid"} -->
<!-- wp:group {"className":"home-news-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group home-news-card">
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","className":"home-news-card__image"} /-->
<!-- wp:group {"className":"home-news-card__body","layout":{"type":"constrained"}} -->
<div class="wp-block-group home-news-card__body">
<!-- wp:post-date {"className":"home-news-card__date"} /-->
<!-- wp:post-title {"level":3,"isLink":true,"className":"home-news-card__title"} /-->
<!-- wp:post-excerpt {"moreText":"Read more","excerptLength":18,"className":"home-news-card__excerpt"} /-->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"className":"home-news-no-results"} -->
<p class="home-news-no-results">No recent news articles found. Check back soon.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results -->

</div>
<!-- /wp:query -->

</div>
<!-- /wp:group -->
