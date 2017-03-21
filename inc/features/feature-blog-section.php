<?php
/**
 * Customizer functionality for the Blog section.
 *
 * @package Imma
 * @since Imma 1.0
 */

// Load Customizer multiple choice control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-modules/customizer-multiple-choice/class-customizer-multiple-choice.php' );

if ( ! function_exists( 'imma_blog_customize_register' ) ) :
	/**
	 * Hook controls for Blog section to Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 */
	function imma_blog_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

		$wp_customize->add_section( 'imma_blog', array(
			'title' => esc_html__( 'Blog', 'imma' ),
			'panel' => 'imma_frontpage_sections',
			'priority' => apply_filters( 'imma_section_priority', 70, 'imma_blog' ),
		));


		$wp_customize->add_setting( 'imma_blog_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default' => false,
		) );
		$wp_customize->add_control( 'imma_blog_hide', array(
			'type' => 'checkbox',
			'label' => esc_html__( 'Disable section','imma' ),
			'section' => 'imma_blog',
			'priority' => 1,
		) );


		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section title in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_blog_title', array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));

		$wp_customize->add_control( 'imma_blog_title', array(
			'label' => esc_html__( 'Section Title', 'imma' ),
			'section' => 'imma_blog',
			'priority' => 5,
		));


		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section subtitle in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_blog_subtitle', array(
			'default' => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( 'imma_blog_subtitle', array(
			'label' => esc_html__( 'Section Subtitle', 'imma' ),
			'section' => 'imma_blog',
			'priority' => 10,
		));


		$wp_customize->add_setting( 'imma_blog_post_number', array(
			'default' => 3,
			'sanitize_callback' => 'absint',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( 'imma_blog_post_number', array(
			'label' => esc_html__( 'Number of posts', 'imma' ),
			'section' => 'imma_blog',
			'priority' => 15,
			'type' => 'number',
			'input_attrs'    => array(
				'min'  => 0,
			)
		));

		$wp_customize->add_setting( 'imma_blog_categories_multiple_select', array(
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
			'sanitize_callback' => 'imma_sanitize_multiselect',
		));
		$wp_customize->add_control( new Capri_Customize_Control_Multiple_Select( $wp_customize, 'imma_blog_categories_multiple_select', array(
			'label'    => esc_html__( 'Categories selector', 'imma' ),
			'section'  => 'imma_blog',
			'priority' => 20,
			'type'     => 'multiple-select',
			'choices'  => imma_get_categories( false ),
		)));



	}
	add_action( 'customize_register', 'imma_blog_customize_register' );
endif;


/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_blog_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_blog_title', array(
		'selector'        => '.blog-section .section-title',
		'settings'        => 'imma_blog_title',
		'render_callback' => 'imma_blog_title_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_blog_subtitle', array(
		'selector'        => '.blog-section .section-subtitle',
		'settings'        => 'imma_blog_subtitle',
		'render_callback' => 'imma_blog_subtitle_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_blog_post_number', array(
		'selector'        => '.blog-section .section-content',
		'settings'        => array( 'imma_blog_post_number', 'imma_blog_categories_multiple_select'),
		'render_callback' => 'imma_display_blog_content',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_blog_categories_multiple_select', array(
		'selector'        => '.blog-section .section-content',
		'settings'        => array( 'imma_blog_post_number', 'imma_blog_categories_multiple_select'),
		'render_callback' => 'imma_display_blog_content',
	) );
}
add_action( 'customize_register', 'imma_register_blog_partials' );


if ( ! function_exists( 'imma_sanitize_multiselect' ) ) :
	/**
	 * Sanitize multi select output.
	 *
	 * @since Capri 1.0
	 */
	function imma_sanitize_multiselect( $input ) {
		if ( ! is_array( $input ) ) {
			$output = explode( ',', $input );
		} else {
			$output = $input;
		}
		if ( ! empty( $output ) ) {
			return array_map( 'sanitize_text_field', $output );
		} else {
			return array();
		}
	}
endif;

/**
 *
 */
function imma_get_categories( $placeholder ){
	$imma_categories_array = $placeholder === true ? array( '-' => __( 'Select category','imma' ) ) : array();

	$imma_categories = get_categories();
	if ( ! empty( $imma_categories ) ) {
		foreach ( $imma_categories as $cat ) {
			if ( ! empty( $cat->term_id ) && ! empty( $cat->name ) ) {
				$imma_categories_array[ $cat->term_id ] = $cat->name;
			}
		}
	}
	$imma_categories_array['none'] = __( 'None', 'imma' );
	return $imma_categories_array;
}

/**
 * Callback function for blog title
 * @return string
 */
function imma_blog_title_render_callback(){
	return get_theme_mod('imma_blog_title');
}

/**
 * Callback function for blog subtitle
 * @return string
 */
function imma_blog_subtitle_render_callback(){
	return get_theme_mod('imma_blog_subtitle');
}