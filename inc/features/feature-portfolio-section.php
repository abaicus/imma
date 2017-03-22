<?php
/**
 * Customizer functionality for the Portfolio section.
 *
 * @package Imma
 * @since Imma 1.0
 */

if ( ! function_exists( 'imma_portfolio_customize_register' ) ) :
	/**
	 * Hook controls for Features section to Customizer.
	 *
	 * @since Imma 1.0
	 */
	function imma_portfolio_customize_register( $wp_customize ) {
		$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

		$wp_customize->add_section( 'imma_portfolio', array(
			'title'    => esc_html__( 'Portfolio', 'imma' ),
			'panel'    => 'imma_frontpage_sections',
			'priority' => apply_filters( 'imma_section_priority', 40, 'imma_portfolio' ),
		) );

		$wp_customize->add_setting( 'imma_portfolio_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default'           => false,
		) );
		$wp_customize->add_control( 'imma_portfolio_hide', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Disable section', 'imma' ),
			'section'  => 'imma_portfolio',
			'priority' => 1,
		) );

		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section text in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_portfolio_title', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
			'default'           => $default,
		) );
		$wp_customize->add_control( 'imma_portfolio_title', array(
			'label'    => esc_html__( 'Section Title', 'imma' ),
			'section'  => 'imma_portfolio',
			'priority' => 5,
		) );

		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section subtitle in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_portfolio_subtitle', array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		) );
		$wp_customize->add_control( 'imma_portfolio_subtitle', array(
			'label'    => esc_html__( 'Section Subtitle', 'imma' ),
			'section'  => 'imma_portfolio',
			'priority' => 10,
		) );

		$default = current_user_can( 'edit_posts' ) ? absint( '4' ) : false;
		$wp_customize->add_setting( 'imma_portfolio_posts_count', array(
			'default'           => $default,
			'sanitize_callback' => 'absint',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		) );
		$wp_customize->add_control( 'imma_portfolio_posts_count', array(
			'label'    => esc_html__( 'Number of items', 'imma' ),
			'section'  => 'imma_portfolio',
			'type'     => 'number',
			'priority' => 15,
		) );
	}
	add_action( 'customize_register', 'imma_portfolio_customize_register' );
endif;

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_portfolio_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_portfolio_title', array(
		'selector'        => '.portfolio .section-title',
		'settings'        => array( 'imma_portfolio_title' ),
		'render_callback' => 'imma_partial_callback_portfolio_title',
	) );
	$wp_customize->selective_refresh->add_partial( 'imma_portfolio_subtitle', array(
		'selector'        => '.portfolio .section-subtitle',
		'settings'        => array( 'imma_portfolio_subtitle' ),
		'render_callback' => 'imma_partial_callback_portfolio_subtitle',
	) );
	$wp_customize->selective_refresh->add_partial( 'imma_portfolio_posts_count', array(
		'selector'        => '.portfolio .portfolio-items',
		'settings'        => array( 'imma_portfolio_posts_count' ),
		'render_callback' => 'imma_get_portfolio_content',
	) );


}
add_action( 'customize_register', 'imma_register_portfolio_partials' );
/**
 * Render callback for Portfolio title selective refresh.
 *
 * @return string
 */
function imma_partial_callback_portfolio_title() {
	return get_theme_mod( 'imma_portfolio_title' );
}
/**
 * Render callback for Portfolio subtitle selective refresh.
 *
 * @return string
 */
function imma_partial_callback_portfolio_subtitle() {
	return get_theme_mod( 'imma_portfolio_subtitle' );
}