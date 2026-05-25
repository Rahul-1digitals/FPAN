<?php
/**
 * fpan/clinic-section — server-side render callback.
 *
 * Called by WordPress when the block is rendered on the front end.
 * $content contains the already-rendered HTML of all inner blocks
 * (core/heading, core/paragraph, core/list, etc.).
 *
 * @var array    $attributes  Block attributes: anchorId, includeInNav, navOrder.
 * @var string   $content     Rendered inner blocks HTML.
 * @var WP_Block $block       Block instance.
 */

$anchor_id = isset( $attributes['anchorId'] ) ? sanitize_html_class( $attributes['anchorId'] ) : '';
$id_attr   = $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : '';
?>
<section class="clinic-section"<?php echo $id_attr; ?>>
	<?php echo $content; ?>
</section>
