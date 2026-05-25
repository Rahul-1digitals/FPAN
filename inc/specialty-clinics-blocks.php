<?php
/**
 * Specialty & Primary Care Clinic Blocks
 *
 * Registers two custom blocks:
 *   fpan/clinic-section  — one specialty group with inner content + nav config
 *   fpan/jump-to-nav     — auto-builds Jump To bar from all clinic sections
 *
 * No build step required. Editor scripts use wp.* globals (vanilla JS).
 *
 * @package FPAN_Theme
 */


/* =============================================================================
   BLOCK REGISTRATION
   ============================================================================= */

function fpan_register_clinic_blocks() {

	// ── fpan/clinic-section ────────────────────────────────────────────────────

	wp_register_script(
		'fpan-clinic-section-editor',
		get_template_directory_uri() . '/blocks/clinic-section/editor.js',
		[ 'wp-blocks', 'wp-block-editor', 'wp-components', 'wp-i18n', 'wp-element' ],
		filemtime( get_template_directory() . '/blocks/clinic-section/editor.js' ),
		false   /* load in <head> so it is available before DOMContentLoaded */
	);

	register_block_type(
		get_template_directory() . '/blocks/clinic-section',
		[
			'editor_script'   => 'fpan-clinic-section-editor',
			'render_callback' => 'fpan_render_clinic_section_block',
			'attributes'      => [
				'anchorId'     => [ 'type' => 'string',  'default' => ''   ],
				'includeInNav' => [ 'type' => 'boolean', 'default' => true ],
				'navOrder'     => [ 'type' => 'integer', 'default' => 0    ],
			],
		]
	);

	// ── fpan/jump-to-nav ───────────────────────────────────────────────────────

	wp_register_script(
		'fpan-jump-to-nav-editor',
		get_template_directory_uri() . '/blocks/jump-to-nav/editor.js',
		[ 'wp-blocks', 'wp-block-editor', 'wp-i18n', 'wp-element' ],
		filemtime( get_template_directory() . '/blocks/jump-to-nav/editor.js' ),
		false
	);

	register_block_type(
		get_template_directory() . '/blocks/jump-to-nav',
		[
			'editor_script'   => 'fpan-jump-to-nav-editor',
			'render_callback' => 'fpan_render_jump_to_nav_block',
			'attributes'      => [],
		]
	);
}
add_action( 'init', 'fpan_register_clinic_blocks' );


/* =============================================================================
   RENDER CALLBACKS
   ============================================================================= */

/**
 * Render fpan/clinic-section.
 *
 * Wraps the already-rendered inner blocks HTML in a <section> element
 * and applies the editor-configured anchor ID.
 *
 * @param array  $attributes anchorId, includeInNav, navOrder.
 * @param string $content    Rendered inner blocks HTML.
 * @return string
 */
function fpan_render_clinic_section_block( $attributes, $content ) {
	$anchor_id = isset( $attributes['anchorId'] )
		? sanitize_html_class( $attributes['anchorId'] )
		: '';

	$id_attr = $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : '';

	return '<section class="clinic-section"' . $id_attr . '>' . $content . '</section>';
}


/**
 * Render fpan/jump-to-nav.
 *
 * Parses the current post's raw block content (no rendering — parse only),
 * collects all fpan/clinic-section blocks that have includeInNav = true,
 * sorts them by navOrder, and outputs the sticky navigation markup.
 *
 * @param array  $attributes Empty (block has no attributes).
 * @param string $content    Empty string (block has no inner blocks).
 * @return string
 */
function fpan_render_jump_to_nav_block( $attributes, $content ) {
	global $_wp_current_template_content;

	$sections = [];

	// 1. Try the page/post content first (blocks added via the Page editor).
	$post = get_post();
	if ( $post && ! empty( $post->post_content ) ) {
		$sections = fpan_collect_clinic_nav_sections( parse_blocks( $post->post_content ) );
	}

	// 2. Fallback: blocks were added directly inside the template in the Site Editor.
	//    $_wp_current_template_content holds the full template block HTML during rendering.
	if ( empty( $sections ) && ! empty( $_wp_current_template_content ) ) {
		$sections = fpan_collect_clinic_nav_sections( parse_blocks( $_wp_current_template_content ) );
	}

	if ( empty( $sections ) ) {
		return '';
	}

	ob_start();
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
	<?php
	return ob_get_clean();
}


/* =============================================================================
   HELPER: collect + sort nav sections from parsed block tree
   ============================================================================= */

/**
 * Walk a parsed block tree and return sorted nav data for all
 * fpan/clinic-section blocks that have includeInNav !== false.
 *
 * Recursive so clinic-section blocks nested inside wp:group or other
 * container blocks are also discovered.
 *
 * @param  array $blocks Return value of parse_blocks().
 * @return array         Array of [ 'id' => string, 'label' => string, 'order' => int ].
 */
function fpan_collect_clinic_nav_sections( $blocks ) {
	$sections = [];

	foreach ( $blocks as $block ) {

		if ( 'fpan/clinic-section' === $block['blockName'] ) {
			$attrs = $block['attrs'];

			// Default: include in nav. Only exclude when explicitly set to false.
			if ( isset( $attrs['includeInNav'] ) && false === $attrs['includeInNav'] ) {
				// Recurse into inner blocks even for excluded sections,
				// in case a clinic-section is nested inside another.
				if ( ! empty( $block['innerBlocks'] ) ) {
					$sections = array_merge(
						$sections,
						fpan_collect_clinic_nav_sections( $block['innerBlocks'] )
					);
				}
				continue;
			}

			$anchor_id = isset( $attrs['anchorId'] )
				? sanitize_html_class( $attrs['anchorId'] )
				: '';

			if ( ! $anchor_id ) {
				continue; // Can't build an anchor link without an ID.
			}

			// Extract plain-text label from the first core/heading inner block.
			$label = '';
			foreach ( $block['innerBlocks'] as $inner ) {
				if ( 'core/heading' === $inner['blockName'] ) {
					$label = wp_strip_all_tags( $inner['innerHTML'] );
					break;
				}
			}

			// Fallback: humanise the anchor ID itself.
			if ( ! $label ) {
				$label = ucwords( str_replace( '-', ' ', $anchor_id ) );
			}

			$sections[] = [
				'id'    => $anchor_id,
				'label' => $label,
				'order' => (int) ( $attrs['navOrder'] ?? 0 ),
			];

			// Recurse into inner blocks (unlikely but safe).
			if ( ! empty( $block['innerBlocks'] ) ) {
				$sections = array_merge(
					$sections,
					fpan_collect_clinic_nav_sections( $block['innerBlocks'] )
				);
			}

		} elseif ( ! empty( $block['innerBlocks'] ) ) {
			// Non-clinic block — still recurse (e.g. clinic-section inside wp:group).
			$sections = array_merge(
				$sections,
				fpan_collect_clinic_nav_sections( $block['innerBlocks'] )
			);
		}
	}

	usort( $sections, fn( $a, $b ) => $a['order'] <=> $b['order'] );

	return $sections;
}


/* =============================================================================
   FRONT-END JS — enqueue only when blocks are present
   ============================================================================= */

function fpan_enqueue_clinic_scripts() {
	if ( has_block( 'fpan/jump-to-nav' ) || has_block( 'fpan/clinic-section' ) ) {
		wp_enqueue_script(
			'fpan-specialty-clinics',
			get_template_directory_uri() . '/assets/js/specialty-clinics.js',
			[],
			filemtime( get_template_directory() . '/assets/js/specialty-clinics.js' ),
			true  /* footer */
		);
	}
}
add_action( 'wp_enqueue_scripts', 'fpan_enqueue_clinic_scripts' );
