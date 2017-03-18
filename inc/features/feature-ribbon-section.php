<?php
/**
 * Customizer functionality for the Ribbon section.
 *
 * @package Imma
 * @since Imma 1.0
 */

if ( ! function_exists( 'imma_ribbon_customize_register' ) ) :
	/**
	 * Hook controls for Features section to Customizer.
	 *
	 * @since Imma 1.0
	 */
	function imma_ribbon_customize_register( $wp_customize ) {
		$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

		$wp_customize->add_section( 'imma_ribbon', array(
			'title'    => esc_html__( 'Ribbon', 'imma' ),
			'panel'    => 'imma_frontpage_sections',
			'priority' => apply_filters( 'imma_section_priority', 20, 'imma_ribbon' ),
		) );

		$wp_customize->add_setting( 'imma_ribbon_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default'           => false,
		) );
		$wp_customize->add_control( 'imma_ribbon_hide', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Disable section', 'imma' ),
			'section'  => 'imma_ribbon',
			'priority' => 1,
		) );


		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this section text in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_ribbon_title', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
			'default'          => $default,
		) );
		$wp_customize->add_control( 'imma_ribbon_title', array(
			'label'    => esc_html__( 'Section Title', 'imma' ),
			'section'  => 'imma_ribbon',
			'priority' => 5,
		) );


		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit button label in customizer', 'imma' ) : false;
		$wp_customize->add_setting( 'imma_ribbon_button_text', array(
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
			'default'          => $default
		) );
		$wp_customize->add_control( 'imma_ribbon_button_text', array(
			'label'    => esc_html__( 'Button Text', 'imma' ),
			'section'  => 'imma_ribbon',
			'priority' => 10,
		) );

		$wp_customize->add_setting( 'imma_ribbon_button_link', array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
			'default'           => '#'
		) );
		$wp_customize->add_control( 'imma_ribbon_button_link', array(
			'label'    => esc_html__( 'Button Link', 'imma' ),
			'section'  => 'imma_ribbon',
			'priority' => 15,
		) );

		$default = current_user_can( 'edit_posts' ) ? get_template_directory_uri() . '/img/ribbon.jpg': false;
		$wp_customize->add_setting( 'imma_ribbon_background_image', array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
			'default'           => $default,
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'imma_ribbon_background_image', array(
			'label'    => esc_html__( 'Background Image', 'imma' ),
			'section'  => 'imma_ribbon',
			'priority' => 20,
		) ) );

		/*
		 * SELECTIVE REFRESH
		 */
		if ( isset( $wp_customize->selective_refresh ) ) {
			// Ribbon Text
			$wp_customize->selective_refresh->add_partial( 'imma_ribbon_title', array(
				'selector'        => '.ribbon .text-wrapper h2',
				'settings'        => array( 'imma_ribbon_title' ),
				'render_callback' => 'imma_partial_callback_ribbon_title',
			) );

			//Ribbon Button
			$wp_customize->selective_refresh->add_partial( 'imma_ribbon_button', array(
				'selector' => '.ribbon .button-wrapper',
				'settings' => array( 'imma_ribbon_button_text', 'imma_ribbon_button_link' ),
				'render_callback' => 'imma_partial_callback_ribbon_button',
			) );

		}
	}
	add_action( 'customize_register', 'imma_ribbon_customize_register' );
endif;

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_ribbon_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_ribbon_title', array(
		'selector'        => '.ribbon .text-wrapper h2',
		'settings'        => array( 'imma_ribbon_title' ),
		'render_callback' => 'imma_partial_callback_ribbon_title',
	) );
	//Ribbon Button
	$wp_customize->selective_refresh->add_partial( 'imma_ribbon_button', array(
		'selector' => '.ribbon .button-wrapper',
		'settings' => array( 'imma_ribbon_button_text', 'imma_ribbon_button_link' ),
		'render_callback' => 'imma_partial_callback_ribbon_button',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_ribbon_button_link', array(
		'selector' => '.ribbon .button-wrapper',
		'settings' => array( 'imma_ribbon_button_text', 'imma_ribbon_button_link' ),
		'render_callback' => 'imma_partial_callback_ribbon_button',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_ribbon_background_image', array(
		'selector' => '.ribbon-css',
		'settings' => 'imma_ribbon_background_image',
		'render_callback' => 'imma_partial_callback_ribbon_background',
	) );


}
add_action( 'customize_register', 'imma_register_ribbon_partials' );
/**
 * Render callback for ribbon text selective refresh.
 *
 * @return string
 */
function imma_partial_callback_ribbon_title() {
	return get_theme_mod( 'imma_ribbon_title' );
}

/**
 * Render callback for ribbon button selective refresh.
 *
 * @return string
 */
function imma_partial_callback_ribbon_button() {
	$button = '';
	$text = get_theme_mod( 'imma_ribbon_button_text' );
	$link = get_theme_mod( 'imma_ribbon_button_link' );
	if( ! empty( $text ) ) {
		$button .= '<a href="' . esc_url( $link ) . '" class="btn btn-yellow btn-lg btn-outline">' . esc_html( $text ) . '</a>';
	}
	return $button;
}



function imma_partial_callback_ribbon_background(){
	$imma_ribbon_background_image = get_theme_mod('imma_ribbon_background_image'); ?>
	<style class="imma-ribbon-css">
		.ribbon {
			background-image: url(<?php echo !empty( $imma_ribbon_background_image ) ? esc_url($imma_ribbon_background_image) : 'none' ?>);
		}
	</style>
	<?php
}