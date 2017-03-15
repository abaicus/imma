<?php
/**
 * Customizer functionality for the Services section.
 *
 * @package Imma
 * @since Imma 1.0
 */

// Load Customizer repeater control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-modules/customizer-repeater/functions.php' );

if ( ! function_exists( 'imma_services_customize_register' ) ) :
	/**
	 * Hook controls for Features section to Customizer.
	 *
	 * @since Imma 1.0
	 */
	function imma_services_customize_register( $wp_customize ) {
		$wp_customize->add_section( 'imma_services', array(
			'title' => esc_html__( 'Services', 'imma' ),
			'panel' => 'imma_frontpage_sections',
			'priority' => apply_filters( 'imma_section_priority', 10, 'imma_services' ),
		));

		$wp_customize->add_setting( 'imma_services_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default' => false,
		) );
		$wp_customize->add_control( 'imma_services_hide', array(
			'type' => 'checkbox',
			'label' => esc_html__( 'Disable section','imma' ),
			'section' => 'imma_services',
			'priority' => 1,
		) );
		$wp_customize->add_setting( 'imma_services_title', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));
		$wp_customize->add_control( 'imma_services_title', array(
			'label' => esc_html__( 'Section Title', 'imma' ),
			'section' => 'imma_services',
			'priority' => 5,
		));
		$wp_customize->add_setting( 'imma_services_subtitle', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));
		$wp_customize->add_control( 'imma_services_subtitle', array(
			'label' => esc_html__( 'Section Subtitle', 'imma' ),
			'section' => 'imma_services',
			'priority' => 10,
		));
		$wp_customize->add_setting( 'imma_services_content', array(
			'sanitize_callback' => 'customizer_repeater_sanitize',
		));
		$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'imma_services_content', array(
			'label'   => esc_html__( 'Features Content','imma' ),
			'section' => 'imma_services',
			'priority' => 15,
			'customizer_repeater_icon_control' => true,
			'customizer_repeater_title_control' => true,
			'customizer_repeater_subtitle_control' => true,
			'customizer_repeater_text_control' => true,
			'customizer_repeater_link_control' => true,
			'customizer_repeater_color_control' => true,
		)));
	}
	add_action( 'customize_register', 'imma_services_customize_register' );
endif;