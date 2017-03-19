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
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 */
	function imma_services_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

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


		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section title in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_services_title', array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));

		$wp_customize->add_control( 'imma_services_title', array(
			'label' => esc_html__( 'Section Title', 'imma' ),
			'section' => 'imma_services',
			'priority' => 5,
		));

		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section subtitle in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_services_subtitle', array(
			'default' => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( 'imma_services_subtitle', array(
			'label' => esc_html__( 'Section Subtitle', 'imma' ),
			'section' => 'imma_services',
			'priority' => 10,
		));


		$default = imma_get_services_content_default();
		$wp_customize->add_setting( 'imma_services_content', array(
			'default' => $default,
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
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
		)));
	}
	add_action( 'customize_register', 'imma_services_customize_register' );
endif;

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_services_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_services_title', array(
		'selector'        => '.features .section-title',
		'settings'        => 'imma_services_title',
		'render_callback' => 'imma_services_title_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_services_subtitle', array(
		'selector'        => '.features .section-subtitle',
		'settings'        => 'imma_services_subtitle',
		'render_callback' => 'imma_services_subtitle_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_services_content', array(
		'selector'        => '.features .section-content',
		'settings'        => 'imma_services_content',
		'render_callback' => 'imma_get_services_content',
	) );
}
add_action( 'customize_register', 'imma_register_services_partials' );

/**
 * Return default content for services repeater
 * @return mixed|string|void
 */
function imma_get_services_content_default(){
	if( ! current_user_can( 'edit_posts' ) ){
		return '';
	}
	return json_encode( array(
		array(
			'icon_value' => 'fa-dollar',
			'title'      => esc_html__( 'Small Prices', 'imma' ),
			'subtitle'       => esc_html__( 'Our prices are the smallest! You\'ve got to check them out! Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'imma' ),
			'link'       => '#',
			'text'   => esc_html__( 'Check it out!', 'imma'),
		),
		array(
			'icon_value' => 'fa-star',
			'title'      => esc_html__( 'Guaranteed Satisfaction', 'imma' ),
			'subtitle'       => esc_html__( 'We give our customers satisfaction! Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'imma' ),
			'link'       => '#',
			'text'   => esc_html__( 'Check it out!', 'imma'),
		),
		array(
			'icon_value' => 'fa-gift',
			'title'      => esc_html__( 'Great Products', 'imma' ),
			'subtitle'       => esc_html__( 'Our products are the best products around! Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'imma' ),
			'link'       => '#',
			'text'   => esc_html__( 'Check it out!', 'imma'),
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
function imma_repeater_labels( $string, $id, $control ) {
	if ( $id === 'imma_services_content' ) {
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return esc_html__( 'Text','hestia-pro' );
		}
		if ( $control === 'customizer_repeater_text_control' ) {
			return esc_html__( 'Button Text','hestia-pro' );
		}
	}
	return $string;
}
add_filter( 'repeater_input_labels_filter','imma_repeater_labels', 10 , 3 );

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
function imma_repeater_input_types( $string, $id, $control ) {
	if ( $id === 'imma_services_content' ) {
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return 'textarea';
		}
		if ( $control === 'customizer_repeater_text_control' ) {
			return '';
		}
	}
	return $string;
}
add_filter( 'repeater_input_types_filter','imma_repeater_input_types', 10 , 3 );

/**
 * Callback function for services title
 * @return string
 */
function imma_services_title_render_callback(){
	return get_theme_mod('imma_services_title');
}

/**
 * Callback function for services subtitle
 * @return string
 */
function imma_services_subtitle_render_callback(){
	return get_theme_mod('imma_services_subtitle');
}