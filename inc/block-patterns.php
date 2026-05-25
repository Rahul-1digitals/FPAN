<?php
/**
 * Block Pattern Registration
 *
 * Explicitly registers all theme block patterns.
 * This is more reliable than relying solely on WordPress's auto-discovery
 * from the patterns/ directory (which depends on version and object cache).
 *
 * @package FPAN_Theme
 */

/**
 * Return the rendered HTML content of a pattern file.
 */
function fpan_pattern_content( $filename ) {
	ob_start();
	include get_template_directory() . '/patterns/' . $filename . '.php';
	return ob_get_clean();
}

/**
 * Register all FPAN block patterns.
 * Priority 9 — runs after category registration (priority 5).
 */
function fpan_register_block_patterns() {

	// ── Homepage Hero ──────────────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/home-hero',
		[
			'title'       => __( 'Homepage Hero', 'fpan-theme' ),
			'description' => __( 'Full-width hero section with eyebrow, heading, subheading, and two CTA buttons.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare', 'banner' ],
			'keywords'    => [ 'hero', 'banner', 'cta', 'homepage' ],
			'content'     => fpan_pattern_content( 'home-hero' ),
		]
	);

	// ── Patient Resource Cards ─────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/for-patients-resource-cards',
		[
			'title'       => __( 'Patient Resource Cards', 'fpan-theme' ),
			'description' => __( 'Four education and resource cards — Asthma, Diabetes, Preventive Care, Family Wellness.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'resources', 'cards', 'education', 'patients', 'asthma', 'diabetes' ],
			'content'     => fpan_pattern_content( 'for-patients-resource-cards' ),
		]
	);

	// ── Find a Provider CTA Banner ─────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/cta-find-provider',
		[
			'title'       => __( 'Find a Provider CTA Banner', 'fpan-theme' ),
			'description' => __( 'Full-width navy-to-teal gradient CTA banner linking to the Provider Directory.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare', 'banner' ],
			'keywords'    => [ 'cta', 'provider', 'find', 'banner', 'call to action' ],
			'content'     => fpan_pattern_content( 'cta-find-provider' ),
		]
	);

	// ── Patient Education Videos ───────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/for-patients-video-section',
		[
			'title'       => __( 'Patient Education Videos', 'fpan-theme' ),
			'description' => __( 'Two-column Vimeo video section with section heading and descriptions.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'video', 'vimeo', 'embed', 'education', 'patients', 'media' ],
			'content'     => fpan_pattern_content( 'for-patients-video-section' ),
		]
	);

	// ── External Resource Links ────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/for-patients-resource-links',
		[
			'title'       => __( 'External Resource Links', 'fpan-theme' ),
			'description' => __( 'Three-column external resource links grouped by category — General Health, Asthma, Diabetes.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'resources', 'links', 'external', 'cdc', 'patients' ],
			'content'     => fpan_pattern_content( 'for-patients-resource-links' ),
		]
	);

	// ── About FPAN: Mission, Vision & Strategic Priorities ─────────────────────
	register_block_pattern(
		'fpan-theme/about-mission-vision',
		[
			'title'       => __( 'Mission, Vision & Strategic Priorities', 'fpan-theme' ),
			'description' => __( 'Mission statement, vision statement, and three strategic priority items for the About FPAN page.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'mission', 'vision', 'priorities', 'about', 'fpan', 'strategy' ],
			'content'     => fpan_pattern_content( 'about-mission-vision' ),
		]
	);

	// ── About FPAN: The Quadruple Aim ──────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/about-quadruple-aim',
		[
			'title'       => __( 'The Quadruple Aim', 'fpan-theme' ),
			'description' => __( 'Four-column icon card layout presenting FPAN\'s Quadruple Aim framework.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'quadruple aim', 'outcomes', 'costs', 'experience', 'well-being', 'about' ],
			'content'     => fpan_pattern_content( 'about-quadruple-aim' ),
		]
	);

	// ── About FPAN: Key Stats ──────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/about-stats',
		[
			'title'       => __( 'Key Stats — By the Numbers', 'fpan-theme' ),
			'description' => __( 'Four-column statistics bar on a navy gradient background showing FPAN network scale.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare', 'banner' ],
			'keywords'    => [ 'stats', 'numbers', 'impact', 'providers', 'patients', 'counties' ],
			'content'     => fpan_pattern_content( 'about-stats' ),
		]
	);

	// ── About FPAN: Leadership & Programs Preview ──────────────────────────────
	register_block_pattern(
		'fpan-theme/about-leadership-preview',
		[
			'title'       => __( 'Leadership & Programs Preview', 'fpan-theme' ),
			'description' => __( 'Three-column card grid linking to Staff, Governance, and ACO REACH subsection pages.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'leadership', 'staff', 'governance', 'aco reach', 'team', 'about' ],
			'content'     => fpan_pattern_content( 'about-leadership-preview' ),
		]
	);
}
add_action( 'init', 'fpan_register_block_patterns', 9 );
