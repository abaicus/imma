<?php
/**
 * imma Theme Customizer
 *
 * @package imma
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function imma_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_panel( 'imma_frontpage_sections', array(
		'priority'    => 30,
		'title'       => esc_html__( 'Frontpage Sections', 'imma' ),
		'description' => esc_html__( 'Drag and drop panels to change sections order.', 'imma' ),
	) );

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;
	//Blog section
	$wp_customize->add_section( 'imma_blog_index', array(
		'title'    => esc_html__( 'Blog', 'imma' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'imma_blog_index_title_hide', array(
		'sanitize_callback' => 'imma_sanitize_checkbox',
		'default'           => false,
	) );
	$wp_customize->add_control( 'imma_blog_index_title_hide', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Disable section', 'imma' ),
		'section'  => 'imma_blog_index',
		'priority' => 1,
	) );

	$default = __( 'Edit this title in customizer', 'imma' );
	$wp_customize->add_setting( 'imma_blog_index_title', array(
		'default'           => $default,
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
	) );
	$wp_customize->add_control( 'imma_blog_index_title', array(
		'label'    => __( 'Title', 'imma' ),
		'section'  => 'imma_blog_index',
		'priority' => 5,
	) );
}
add_action( 'customize_register', 'imma_customize_register' );

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_generic_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_blog_index_title', array(
		'selector'        => '.blog .shop-page-title-inner',
		'settings'        => 'imma_blog_index_title',
		'render_callback' => 'imma_blog_index_title_render_callback',
	) );
}
add_action( 'customize_register', 'imma_register_generic_partials' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function imma_customize_preview_js() {
	wp_enqueue_script( 'imma_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'imma_customize_preview_js' );


if ( ! function_exists( 'imma_sanitize_checkbox' ) ) :
	/**
	 * Sanitize checkbox output.
	 *
	 * @since Imma 1.0
	 */
	function imma_sanitize_checkbox( $input ) {
		return ( isset( $input ) && true === (bool) $input ? true : false );
	}
endif;

/**
 * Render callback for blog index title selective refresh
 */
function imma_blog_index_title_render_callback() {
	return get_theme_mod( 'imma_blog_index_title_render_callback' );
}