<?php
/**
 * FPAN Theme Theme Customizer
 *
 * @package FPAN_Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fpan_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* -------------------------------------------------------------------------
	 * Footer Information Section
	 * Appearance → Customize → Footer Information
	 * ------------------------------------------------------------------------- */

	// Section — groups all four fields under one collapsible panel
	$wp_customize->add_section(
		'fpan_footer_info',
		array(
			'title'    => esc_html__( 'Footer Information', 'fpan-theme' ),
			'priority' => 130, // appears after Colors, below default sections
		)
	);

	// --- Footer Description ---
	$wp_customize->add_setting(
		'fpan_footer_description',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'fpan_footer_description',
		array(
			'label'   => esc_html__( 'Footer Description', 'fpan-theme' ),
			'section' => 'fpan_footer_info',
			'type'    => 'textarea',
		)
	);

	// --- Footer Address ---
	$wp_customize->add_setting(
		'fpan_footer_address',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'fpan_footer_address',
		array(
			'label'   => esc_html__( 'Footer Address', 'fpan-theme' ),
			'section' => 'fpan_footer_info',
			'type'    => 'textarea',
		)
	);

	// --- Footer Phone ---
	$wp_customize->add_setting(
		'fpan_footer_phone',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'fpan_footer_phone',
		array(
			'label'   => esc_html__( 'Footer Phone', 'fpan-theme' ),
			'section' => 'fpan_footer_info',
			'type'    => 'text',
		)
	);

	// --- Footer Email ---
	$wp_customize->add_setting(
		'fpan_footer_email',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_email',
		)
	);
	$wp_customize->add_control(
		'fpan_footer_email',
		array(
			'label'   => esc_html__( 'Footer Email', 'fpan-theme' ),
			'section' => 'fpan_footer_info',
			'type'    => 'email',
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'fpan_theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'fpan_theme_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'fpan_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fpan_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fpan_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fpan_theme_customize_preview_js() {
	wp_enqueue_script( 'fpan-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'fpan_theme_customize_preview_js' );
