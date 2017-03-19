<?php
/**
 * Customizer functionality for the Services section.
 *
 * @package Imma
 * @since Imma 1.0
 */

if ( ! function_exists( 'imma_big_title_customize_register' ) ) :
	/**
	 * Hook controls for Big Title section to Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 */
	function imma_big_title_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

		$wp_customize->add_section( 'imma_big_title', array(
			'title' => esc_html__( 'Big Title Section', 'imma' ),
			'panel' => 'imma_frontpage_sections',
			'priority' => apply_filters( 'imma_section_priority', 5, 'imma_big_title' ),
		));

		$wp_customize->add_setting( 'imma_big_title_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default' => false,
		) );
		$wp_customize->add_control( 'imma_big_title_hide', array(
			'type' => 'checkbox',
			'label' => esc_html__( 'Disable section','imma' ),
			'section' => 'imma_big_title',
			'priority' => 1,
		) );


		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this title in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_big_title_title', array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));

		$wp_customize->add_control( 'imma_big_title_title', array(
			'label' => esc_html__( 'Title', 'imma' ),
			'section' => 'imma_big_title',
			'priority' => 5,
		));

		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this subtitle in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_big_title_subtitle', array(
			'default' => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( 'imma_big_title_subtitle', array(
			'label' => esc_html__( 'Subtitle', 'imma' ),
			'section' => 'imma_big_title',
			'priority' => 10,
		));

		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this button in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_big_title_button_text', array(
			'default' => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( 'imma_big_title_button_text', array(
			'label' => esc_html__( 'Button Text', 'imma' ),
			'section' => 'imma_big_title',
			'priority' => 15,
		));

		$default = current_user_can( 'edit_posts' ) ? esc_url( '#' ) : false;
		$wp_customize->add_setting( 'imma_big_title_button_link', array(
			'default' => $default,
			'sanitize_callback' => 'esc_url_raw',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( 'imma_big_title_button_link', array(
			'label' => esc_html__( 'Button Link', 'imma' ),
			'section' => 'imma_big_title',
			'priority' => 20,
		));

		$default = current_user_can( 'edit_posts' ) ? get_template_directory_uri() . '/img/cover.jpg' : false;
		$wp_customize->add_setting( 'imma_big_title_background', array(
			'default' => $default,
			'sanitize_callback' => 'esc_url_raw',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control(  new WP_Customize_Image_Control ( $wp_customize, 'imma_big_title_background', array(
			'label' => esc_html__( 'Background', 'imma' ),
			'section' => 'imma_big_title',
			'priority' => 25,
		)));
	}
	add_action( 'customize_register', 'imma_big_title_customize_register' );
endif;

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_big_title_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_big_title_title', array(
		'selector'        => '.cover-caption h1',
		'settings'        => 'imma_big_title_title',
		'render_callback' => 'imma_big_title_title_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_big_title_subtitle', array(
		'selector'        => '.cover-caption p',
		'settings'        => 'imma_big_title_subtitle',
		'render_callback' => 'imma_big_title_subtitle_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_big_title_button', array(
		'selector'        => '.cover-caption .button-wrapper',
		'settings'        => array( 'imma_big_title_button_text' ,'imma_big_title_button_link' ),
		'render_callback' => 'imma_partial_callback_big_title_button',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_big_title_background_image', array(
		'selector' => '.big-title-css',
		'settings' => 'imma_big_title_background',
		'render_callback' => 'imma_partial_callback_big_title_background',
	) );
}
add_action( 'customize_register', 'imma_register_big_title_partials' );

/**
 * Callback function for big tite section title
 * @return string
 */
function imma_big_title_title_render_callback(){
	return get_theme_mod('imma_big_title_title');
}

/**
 * Callback function for big title section subtitle
 * @return string
 */
function imma_big_title_subtitle_render_callback(){
	return get_theme_mod('imma_big_title_subtitle');
}

/**
 * Render callback for big title button selective refresh.
 *
 * @return string
 */
function imma_partial_callback_big_title_button() {
	$button = '';
	$text   = get_theme_mod( 'imma_big_title_button_text' );
	$link   = get_theme_mod( 'imma_big_title_button_link' );
	if ( ! empty( $text ) ) {
		$button .= '<a href="' . esc_url( $link ) . '" class="btn btn-yellow btn-lg">' . esc_html( $text ) . '</a>';
	}

	return $button;
}

function imma_partial_callback_big_title_background(){
	$imma_big_title_background_image = get_theme_mod('imma_big_title_background'); ?>
	<style class="big-title-css">
		#cover {
			background-image: url(<?php echo ! empty( $imma_big_title_background_image ) ? esc_url($imma_big_title_background_image) : 'none' ?>);
		}
	</style>
	<?php
}