/**
 * fpan/jump-to-nav — block editor registration.
 * No build step: uses WordPress global APIs via wp.* namespace.
 * Dependencies: wp-blocks, wp-block-editor, wp-i18n, wp-element
 *
 * Shows an editor-only placeholder. The real nav is rendered server-side.
 */
(function () {
	'use strict';

	var el               = wp.element.createElement;
	var __               = wp.i18n.__;
	var registerBlockType = wp.blocks.registerBlockType;
	var useBlockProps    = wp.blockEditor.useBlockProps;

	registerBlockType( 'fpan/jump-to-nav', {

		edit: function () {
			var blockProps = useBlockProps( { className: 'clinic-jump-nav-placeholder' } );

			return el( 'div', blockProps,
				el( 'div', { className: 'clinic-jump-nav-placeholder__inner' },
					el( 'span', { className: 'clinic-jump-nav-placeholder__icon' }, '↓' ),
					el( 'span', { className: 'clinic-jump-nav-placeholder__text' },
						__( 'Jump To Navigation — auto-generated from Clinic Section blocks below', 'fpan-theme' )
					)
				)
			);
		},

		/* Fully server-side rendered — no saved HTML needed. */
		save: function () {
			return null;
		}
	} );

} )();
