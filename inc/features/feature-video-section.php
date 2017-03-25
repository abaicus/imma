<?php
/**
 * Customizer functionality for the About section.
 *
 * @package WordPress
 * @subpackage Imma
 * @since Imma 1.0
 */

/**
 * Hook controls for Video section to Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since Imma 1.0
 */
function imma_video_customize_register( $wp_customize ) {
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;
	$wp_customize->add_section( 'imma_video', array(
		'title'    => esc_html__( 'Video', 'imma' ),
		'panel'    => 'imma_frontpage_sections',
		'priority' => apply_filters( 'imma_section_priority', 70, 'imma_video' ),
	) );

	$wp_customize->add_setting( 'imma_video_hide', array(
		'sanitize_callback' => 'imma_sanitize_checkbox',
		'default'           => false,
	) );
	$wp_customize->add_control( 'imma_video_hide', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Disable section', 'imma' ),
		'section'  => 'imma_video',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'imma_video_mute_toggle', array(
		'sanitize_callback' => 'imma_sanitize_checkbox',
		'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		'default'           => true,
	) );
	$wp_customize->add_control( 'imma_video_mute_toggle', array(
		'type'     => 'checkbox',
		'label'    => __( 'Mute audio', 'imma' ),
		'section'  => 'imma_video',
		'priority' => 5,
	) );

	$wp_customize->add_setting( 'imma_video_focus_toggle', array(
		'sanitize_callback' => 'imma_sanitize_checkbox',
		'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		'default'           => true,
	) );
	$wp_customize->add_control( 'imma_video_focus_toggle', array(
		'type'     => 'checkbox',
		'label'    => __( 'Pause when window loses focus', 'imma' ),
		'section'  => 'imma_video',
		'priority' => 6,
	) );

	$wp_customize->add_setting( 'imma_video_padding', array(
		'sanitize_callback' => 'esc_attr',
		'default'           => '250',
		'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
	) );
	$wp_customize->add_control( 'imma_video_padding', array(
		'type'        => 'number',
		'section'     => 'imma_video',
		'label'       => __( 'Height', 'imma' ),
		'priority'    => 7,
		'input_attrs' => array(
			'min'    => 100,
			'max'    => 500,
			'step'   => 5,
		),
	) );

	$wp_customize->add_setting( 'imma_video_link', array(
		'sanitize_callback' => 'esc_url',
		'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
	) );
	$wp_customize->add_control( 'imma_video_link', array(
		'label'    => __( 'Video Link', 'imma' ),
		'section'  => 'imma_video',
		'priority' => 10,
	) );

	$wp_customize->add_setting( 'imma_video_text', array(
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
	) );
	$wp_customize->add_control( new Imma_Page_Editor( $wp_customize, 'imma_video_text', array(
		'label'       => __( 'Text', 'imma' ),
		'description' => __( 'You can also use html basic tags here.', 'imma' ),
		'section'     => 'imma_video',
		'priority'    => 15,
	) ) );
}
add_action( 'customize_register', 'imma_video_customize_register' );
/**
 * Add selective refresh for about section controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function imma_register_video_partials( $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_video_text', array(
		'selector'        => '.video-section-content',
		'settings'        => array( 'imma_video_text' ),
		'render_callback' => 'imma_video_text_callback',
	) );
}
add_action( 'customize_register', 'imma_register_video_partials' );

/**
 * Render callback function for video text content.
 *
 * @return string
 */
function imma_video_text_callback() {
	return get_theme_mod( 'imma_video_text' );
}