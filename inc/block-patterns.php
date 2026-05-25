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

	// ── Staff Section ──────────────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/staff-section',
		[
			'title'       => __( 'Staff Section', 'fpan-theme' ),
			'description' => __( 'A grouped staff section with a heading and a responsive 3-column card grid. Insert once per team group. Replace placeholder names and photos with real content.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'staff', 'team', 'leadership', 'cards', 'grid', 'people', 'section' ],
			'content'     => fpan_pattern_content( 'staff-section' ),
		]
	);

	// ── Staff Card ─────────────────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/staff-card',
		[
			'title'       => __( 'Staff Card', 'fpan-theme' ),
			'description' => __( 'A single staff profile card with circular photo, name, and title. Insert inside a Staff Section grid to add more team members.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'staff', 'card', 'profile', 'headshot', 'team member', 'person' ],
			'content'     => fpan_pattern_content( 'staff-card' ),
		]
	);

	// ── Governance Overview ────────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/governance-overview',
		[
			'title'       => __( 'Governance Overview', 'fpan-theme' ),
			'description' => __( 'Three-column overview cards explaining Board of Directors, Operating Committee, and Sub-committees.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'governance', 'board', 'overview', 'committees', 'structure', 'about' ],
			'content'     => fpan_pattern_content( 'governance-overview' ),
		]
	);

	// ── Governance Jump Navigation ─────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/governance-jump-nav',
		[
			'title'       => __( 'Governance Jump Navigation', 'fpan-theme' ),
			'description' => __( 'Horizontal pill-link navigation bar for jumping to committee sections. No JavaScript required.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'jump nav', 'anchor', 'navigation', 'committees', 'governance' ],
			'content'     => fpan_pattern_content( 'governance-jump-nav' ),
		]
	);

	// ── Committee Section ──────────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/committee-section',
		[
			'title'       => __( 'Committee Section', 'fpan-theme' ),
			'description' => __( 'A full committee section with heading, description, and a 2-column member grid. Insert once per committee. Update the heading, anchor ID (Advanced tab), and member placeholders.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'committee', 'governance', 'members', 'board', 'section', 'leadership' ],
			'content'     => fpan_pattern_content( 'committee-section' ),
		]
	);

	// ── Committee Member Entry ─────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/committee-member',
		[
			'title'       => __( 'Committee Member Entry', 'fpan-theme' ),
			'description' => __( 'A single committee member entry with name and role. Insert inside a Committee Section\'s member grid to add more members.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'committee', 'member', 'governance', 'person', 'name', 'role', 'board' ],
			'content'     => fpan_pattern_content( 'committee-member' ),
		]
	);

	// ── ACO REACH: Status Notice ───────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/aco-reach-notice',
		[
			'title'       => __( 'ACO REACH Status Notice', 'fpan-theme' ),
			'description' => __( 'Informational notice banner for ACO REACH participation status. Update text as needed.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'aco', 'reach', 'notice', 'status', 'program', 'ended' ],
			'content'     => fpan_pattern_content( 'aco-reach-notice' ),
		]
	);

	// ── ACO REACH: Jump Navigation ─────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/aco-reach-jump-nav',
		[
			'title'       => __( 'ACO REACH Jump Navigation', 'fpan-theme' ),
			'description' => __( 'Horizontal anchor-link navigation bar for jumping to ACO REACH page sections. No JavaScript required.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'aco', 'reach', 'jump nav', 'anchor', 'navigation', 'links' ],
			'content'     => fpan_pattern_content( 'aco-reach-jump-nav' ),
		]
	);

	// ── ACO REACH: Provider Documents ─────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/aco-reach-documents',
		[
			'title'       => __( 'ACO REACH Provider Documents', 'fpan-theme' ),
			'description' => __( 'Download cards for the Participating Providers List and Preferred Providers List Excel documents.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'aco', 'reach', 'documents', 'download', 'providers', 'excel' ],
			'content'     => fpan_pattern_content( 'aco-reach-documents' ),
		]
	);

	// ── ACO REACH: People Section ──────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/aco-reach-people-section',
		[
			'title'       => __( 'ACO REACH People Section', 'fpan-theme' ),
			'description' => __( 'Reusable 2-column person card grid for ACO REACH Leadership and Governing Body sections. Update heading and set anchor ID in Advanced tab.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'aco', 'reach', 'leadership', 'governing body', 'people', 'members', 'grid' ],
			'content'     => fpan_pattern_content( 'aco-reach-people-section' ),
		]
	);

	// ── ACO REACH: Metrics Table ───────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/aco-reach-metrics-section',
		[
			'title'       => __( 'ACO REACH Metrics Table', 'fpan-theme' ),
			'description' => __( 'Data table section for ACO REACH performance metrics. Defaults to Shared Savings & Losses layout. Reuse for Quality Measures by updating heading, anchor, and column headers.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'aco', 'reach', 'metrics', 'table', 'shared savings', 'quality measures', 'performance' ],
			'content'     => fpan_pattern_content( 'aco-reach-metrics-section' ),
		]
	);

	// ── ACO REACH: External Resource CTA ──────────────────────────────────────
	register_block_pattern(
		'fpan-theme/aco-reach-resource-cta',
		[
			'title'       => __( 'ACO REACH External Resource CTA', 'fpan-theme' ),
			'description' => __( 'Navy gradient CTA banner linking to external ACO REACH resources. Update the button URL to point to M Health Fairview.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare', 'banner' ],
			'keywords'    => [ 'aco', 'reach', 'cta', 'resources', 'external', 'm health fairview' ],
			'content'     => fpan_pattern_content( 'aco-reach-resource-cta' ),
		]
	);

	// ── Membership: Benefit Cards ──────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/membership-benefit-cards',
		[
			'title'       => __( 'Membership Benefit Cards', 'fpan-theme' ),
			'description' => __( 'Four-column icon card grid presenting FPAN network membership benefits. Includes section eyebrow, heading, intro, and one card per benefit area.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'membership', 'benefits', 'network', 'cards', 'icons', 'join' ],
			'content'     => fpan_pattern_content( 'membership-benefit-cards' ),
		]
	);

	// ── Membership: Content Section ────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/membership-content-section',
		[
			'title'       => __( 'Membership Content Section', 'fpan-theme' ),
			'description' => __( 'Reusable content section with heading, description, and bullet list. Insert once per topic on Member Responsibilities and Quality Improvement pages. Update heading and set anchor ID in Advanced tab.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'membership', 'section', 'content', 'responsibilities', 'quality', 'list' ],
			'content'     => fpan_pattern_content( 'membership-content-section' ),
		]
	);

	// ── Membership: Apply CTA ──────────────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/membership-apply-cta',
		[
			'title'       => __( 'Membership Apply CTA', 'fpan-theme' ),
			'description' => __( 'Call-to-action banner for joining or contacting FPAN about membership. Shared across all three Membership section pages.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare', 'banner' ],
			'keywords'    => [ 'membership', 'apply', 'join', 'cta', 'contact', 'network' ],
			'content'     => fpan_pattern_content( 'membership-apply-cta' ),
		]
	);

	// ── Membership: Navigation Cards ──────────────────────────────────────────
	register_block_pattern(
		'fpan-theme/membership-nav-cards',
		[
			'title'       => __( 'Membership Navigation Cards', 'fpan-theme' ),
			'description' => __( 'Two-column related page navigation cards for the Membership section. Pre-populated with Member Responsibilities and Quality Improvement. Update heading text and hrefs per page.', 'fpan-theme' ),
			'categories'  => [ 'fpan-healthcare' ],
			'keywords'    => [ 'membership', 'navigation', 'related', 'also see', 'cards', 'links' ],
			'content'     => fpan_pattern_content( 'membership-nav-cards' ),
		]
	);
}
add_action( 'init', 'fpan_register_block_patterns', 9 );
