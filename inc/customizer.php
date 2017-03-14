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
		'priority' => 30,
		'title' => esc_html__( 'Frontpage Sections', 'imma' ),
		'description' => esc_html__( 'Drag and drop panels to change sections order.','imma' ),
	));
}
add_action( 'customize_register', 'imma_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function imma_customize_preview_js() {
	wp_enqueue_script( 'imma_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'imma_customize_preview_js' );
