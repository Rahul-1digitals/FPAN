<?php
/**
 * fpan/jump-to-nav — server-side render callback.
 *
 * Parses the current post's block content to discover all fpan/clinic-section
 * blocks, filters by includeInNav, sorts by navOrder, and renders the sticky
 * Jump To navigation bar.
 *
 * No database queries — reads block attributes directly from post_content
 * via parse_blocks(), which does not trigger any block rendering.
 *
 * @var array    $attributes  Block attributes (empty — this block has none).
 * @var string   $content     Empty string (no inner blocks).
 * @var WP_Block $block       Block instance.
 */

$post = get_post();
if ( ! $post || empty( $post->post_content ) ) {
	return;
}

$sections = fpan_collect_clinic_nav_sections( parse_blocks( $post->post_content ) );

if ( empty( $sections ) ) {
	return;
}
?>
<nav class="clinic-jump-nav"
	 aria-label="<?php esc_attr_e( 'Jump to section', 'fpan-theme' ); ?>">

	<div class="clinic-jump-nav__inner">

		<span class="clinic-jump-nav__label" aria-hidden="true">
			<?php esc_html_e( 'Jump To:', 'fpan-theme' ); ?>
		</span>

		<ul class="clinic-jump-nav__list" role="list">
			<?php foreach ( $sections as $section ) : ?>
			<li class="clinic-jump-nav__item">
				<a href="#<?php echo esc_attr( $section['id'] ); ?>"
				   class="clinic-jump-nav__link"
				   data-jump-target="<?php echo esc_attr( $section['id'] ); ?>">
					<?php echo esc_html( $section['label'] ); ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>

	</div>
</nav>
