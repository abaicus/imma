<?php
/**
 * Customizer functionality for the Slider section.
 *
 * @package Imma
 * @since Imma 1.0
 */

remove_action( 'customize_register', 'imma_big_title_customize_register' );
remove_action( 'customize_register', 'imma_register_big_title_partials' );

// Load Customizer repeater control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-modules/customizer-repeater/functions.php' );

if ( ! function_exists( 'imma_slider_customize_register' ) ) :
	/**
	 * Hook controls for Slider section to Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 */
	function imma_slider_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

		$wp_customize->add_section( 'imma_slider', array(
			'title'    => esc_html__( 'Slider Section', 'imma' ),
			'panel'    => 'imma_frontpage_sections',
			'priority' => apply_filters( 'imma_section_priority', 5, 'imma_slider' ),
		) );

		$wp_customize->add_setting( 'imma_slider_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default'           => false,
		) );
		$wp_customize->add_control( 'imma_slider_hide', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Disable section', 'imma' ),
			'section'  => 'imma_slider',
			'priority' => 1,
		) );

		$wp_customize->add_setting( 'imma_slider_inidicators_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default'           => false,
		) );
		$wp_customize->add_control( 'imma_slider_inidicators_hide', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Disable slider indicators', 'imma' ),
			'section'  => 'imma_slider',
			'priority' => 5,
		) );

		$wp_customize->add_setting( 'imma_slider_arrows_link', array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
			'default'           => '#'
		) );
		$wp_customize->add_control( 'imma_slider_arrows_link', array(
			'label'    => esc_html__( 'Bottom Arrows Link', 'imma' ),
			'section'  => 'imma_slider',
			'priority' => 5,
		) );

		$default = imma_get_slider_content_default();
		$wp_customize->add_setting( 'imma_slider_content', array(
			'default'           => $default,
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
		) );
		$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'imma_slider_content', array(
			'label'                                => esc_html__( 'Slider Content', 'imma' ),
			'section'                              => 'imma_slider',
			'priority'                             => 15,
			'customizer_repeater_image_control'    => true,
			'customizer_repeater_title_control'    => true,
			'customizer_repeater_subtitle_control' => true,
			'customizer_repeater_text_control'     => true,
			'customizer_repeater_link_control'     => true,
		) ) );
	}
	add_action( 'customize_register', 'imma_slider_customize_register' );
endif;

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_slider_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_slider_content', array(
		'selector'        => '.features .section-content',
		'settings'        => 'imma_slider_content',
		'render_callback' => 'imma_get_slider_content',
	) );
}
add_action( 'customize_register', 'imma_register_slider_partials' );

/**
 * Return default content for slider repeater
 * @return mixed|string|void
 */
function imma_get_slider_content_default() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		return '';
	}

	return json_encode( array(
		array(
			'image_url'=> get_template_directory_uri() . '/img/cover.jpg',
			'title'    => esc_html__( 'Edit this slider in Customizer', 'imma' ),
			'subtitle' => esc_html__( 'We\'ve made it easy for users to customize this theme!', 'imma' ),
			'link'     => '#',
			'text'     => esc_html__( 'Go to customizer', 'imma' ),
		),
		array(
			'image_url'  => get_template_directory_uri() . '/img/portfolio5.jpg',
			'title'      => esc_html__( 'We are IMMA', 'imma' ),
			'subtitle'   => esc_html__( 'Easy to customize. Easy to use.', 'imma' ),
			'link'       => '#',
			'text'       => esc_html__( 'Go to customizer!', 'imma' ),
		),
	) );
}

/**
 * Filter to modify input label in repeater control
 * You can filter by control id and input name.
 *
 * @param string $string Input label.
 * @param string $id Input id.
 * @param string $control Control name.
 *
 * @return string
 */
function imma_slider_repeater_labels( $string, $id, $control ) {
	if ( $id === 'imma_slider_content' ) {
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return esc_html__( 'Text','hestia-pro' );
		}
		if ( $control === 'customizer_repeater_text_control' ) {
			return esc_html__( 'Button Text','hestia-pro' );
		}
		if ( $control === 'customizer_repeater_image_control' ) {
			return esc_html__( 'Slide Background','hestia-pro' );
		}
	}
	return $string;
}
add_filter( 'repeater_input_labels_filter','imma_slider_repeater_labels', 10 , 3 );

/**
 * Filter to modify input type in repeater control
 * You can filter by control id and input name.
 *
 * @param string $string Input label.
 * @param string $id Input id.
 * @param string $control Control name.
 *
 * @return string
 */
function imma_slider_repeater_input_types( $string, $id, $control ) {
	if ( $id === 'imma_slider_content' ) {
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return 'textarea';
		}
		if ( $control === 'customizer_repeater_text_control' ) {
			return '';
		}
	}
	return $string;
}
add_filter( 'repeater_input_types_filter','imma_slider_repeater_input_types', 10 , 3 );