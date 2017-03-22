<?php
/**
 * Customizer functionality for the Clients section.
 *
 * @package Imma
 * @since Imma 1.0
 */

// Load Customizer repeater control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-modules/customizer-repeater/functions.php' );

if ( ! function_exists( 'imma_clients_customize_register' ) ) :
	/**
	 * Hook controls for Clients section to Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 */
	function imma_clients_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

		$wp_customize->add_section( 'imma_clients', array(
			'title' => esc_html__( 'Clients', 'imma' ),
			'panel' => 'imma_frontpage_sections',
			'priority' => apply_filters( 'imma_section_priority', 70, 'imma_clients' ),
		));


		$wp_customize->add_setting( 'imma_clients_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default' => false,
		) );
		$wp_customize->add_control( 'imma_clients_hide', array(
			'type' => 'checkbox',
			'label' => esc_html__( 'Disable section','imma' ),
			'section' => 'imma_clients',
			'priority' => 1,
		) );


		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section title in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_clients_title', array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));

		$wp_customize->add_control( 'imma_clients_title', array(
			'label' => esc_html__( 'Section Title', 'imma' ),
			'section' => 'imma_clients',
			'priority' => 5,
		));


		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section subtitle in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_clients_subtitle', array(
			'default' => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( 'imma_clients_subtitle', array(
			'label' => esc_html__( 'Section Subtitle', 'imma' ),
			'section' => 'imma_clients',
			'priority' => 10,
		));


		$default = imma_get_clients_content_default();
		$wp_customize->add_setting( 'imma_clients_content', array(
			'default' => $default,
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'imma_clients_content', array(
			'label'   => esc_html__( 'Features Content','imma' ),
			'section' => 'imma_clients',
			'priority' => 15,
			'customizer_repeater_image_control' => true,
			'customizer_repeater_link_control' => true,
		)));
	}
	add_action( 'customize_register', 'imma_clients_customize_register' );
endif;

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_clients_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_clients_title', array(
		'selector'        => '.clients .section-title',
		'settings'        => 'imma_clients_title',
		'render_callback' => 'imma_clients_title_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_clients_subtitle', array(
		'selector'        => '.clients .section-subtitle',
		'settings'        => 'imma_clients_subtitle',
		'render_callback' => 'imma_clients_subtitle_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_clients_content', array(
		'selector'        => '.clients .section-content',
		'settings'        => 'imma_clients_content',
		'render_callback' => 'imma_get_clients_content',
	) );
}
add_action( 'customize_register', 'imma_register_clients_partials' );

/**
 * Return default content for clients repeater
 * @return mixed|string|void
 */
function imma_get_clients_content_default(){
	if( ! current_user_can( 'edit_posts' ) ){
		return '';
	}
	return json_encode( array(
		array(
			'image_url' => get_template_directory_uri() . '/img/clients_1.png',
			'link'       => '#',
		),
		array(
			'image_url' => get_template_directory_uri() . '/img/clients_2.png',
			'link'       => '#',
		),
		array(
			'image_url' => get_template_directory_uri() . '/img/clients_3.png',
			'link'       => '#',
		),
		array(
			'image_url' => get_template_directory_uri() . '/img/clients_4.png',
			'link'       => '#',
		),
		array(
			'image_url' => get_template_directory_uri() . '/img/clients_5.png',
			'link'       => '#',
		),
		array(
			'image_url' => get_template_directory_uri() . '/img/clients_6.png',
			'link'       => '#',
		),
	) );
}

/**
 * Callback function for clients title
 * @return string
 */
function imma_clients_title_render_callback(){
	return get_theme_mod('imma_clients_title');
}

/**
 * Callback function for services subtitle
 * @return string
 */
function imma_clients_subtitle_render_callback(){
	return get_theme_mod('imma_clients_subtitle');
}