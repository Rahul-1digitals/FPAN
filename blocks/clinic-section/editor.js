/**
 * fpan/clinic-section — block editor registration.
 * No build step: uses WordPress global APIs via wp.* namespace.
 * Dependencies: wp-blocks, wp-block-editor, wp-components, wp-i18n, wp-element
 */
(function () {
	'use strict';

	var el               = wp.element.createElement;
	var __               = wp.i18n.__;
	var registerBlockType = wp.blocks.registerBlockType;
	var useBlockProps    = wp.blockEditor.useBlockProps;
	var useInnerBlocksProps = wp.blockEditor.useInnerBlocksProps;
	var InnerBlocks      = wp.blockEditor.InnerBlocks;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody        = wp.components.PanelBody;
	var ToggleControl    = wp.components.ToggleControl;
	var TextControl      = wp.components.TextControl;
	var Notice           = wp.components.Notice;

	/** Default inner-blocks template shown to a new Clinic Section */
	var SECTION_TEMPLATE = [
		[ 'core/heading',   { level: 2, placeholder: __( 'Specialty name — e.g. Cardiology', 'fpan-theme' ) } ],
		[ 'core/paragraph', { placeholder: __( 'Optional short description…', 'fpan-theme' ) } ],
		[ 'core/list',      {} ]
	];

	registerBlockType( 'fpan/clinic-section', {

		/**
		 * Editor UI — inspector panel + inner blocks canvas.
		 */
		edit: function ( props ) {
			var attributes   = props.attributes;
			var setAttributes = props.setAttributes;

			var blockProps = useBlockProps( { className: 'clinic-section clinic-section--editor' } );
			var innerProps = useInnerBlocksProps( blockProps, {
				template:     SECTION_TEMPLATE,
				templateLock: false
			} );

			var missingId = attributes.includeInNav && ! attributes.anchorId;

			return el( 'div', null,

				/* ── Inspector sidebar ── */
				el( InspectorControls, null,
					el( PanelBody,
						{ title: __( 'Jump To Navigation', 'fpan-theme' ), initialOpen: true },

						missingId && el( Notice,
							{ status: 'warning', isDismissible: false },
							__( 'Add a Section ID so this section appears in the Jump To bar.', 'fpan-theme' )
						),

						el( TextControl, {
							label: __( 'Section ID', 'fpan-theme' ),
							help:  __( 'Lowercase letters and hyphens only — used as the page anchor (e.g. "cardiology").', 'fpan-theme' ),
							value: attributes.anchorId,
							onChange: function ( val ) {
								setAttributes( {
									anchorId: val
										.toLowerCase()
										.replace( /[^a-z0-9]+/g, '-' )
										.replace( /^-|-$/g, '' )
								} );
							}
						} ),

						el( ToggleControl, {
							label:   __( 'Include in Jump To navigation', 'fpan-theme' ),
							checked: attributes.includeInNav,
							onChange: function ( val ) { setAttributes( { includeInNav: val } ); }
						} ),

						el( TextControl, {
							label: __( 'Navigation order', 'fpan-theme' ),
							help:  __( 'Lower numbers appear first in the Jump To bar.', 'fpan-theme' ),
							type:  'number',
							min:   '0',
							value: String( attributes.navOrder ),
							onChange: function ( val ) {
								setAttributes( { navOrder: Math.max( 0, parseInt( val, 10 ) || 0 ) } );
							}
						} )
					)
				),

				/* ── Inner blocks canvas ── */
				el( 'div', innerProps )
			);
		},

		/**
		 * Save — serialise inner blocks only (no outer wrapper).
		 * The <section> wrapper is added server-side by render.php.
		 */
		save: function () {
			return el( InnerBlocks.Content, null );
		}
	} );

} )();
