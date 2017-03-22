<?php
/**
 * Customizer functionality for the Stats section.
 *
 * @package Imma
 * @since Imma 1.0
 */

// Load Customizer repeater control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-modules/customizer-repeater/functions.php' );

if ( ! function_exists( 'imma_stats_customize_register' ) ) :
	/**
	 * Hook controls for Clients section to Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 */
	function imma_stats_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

		$wp_customize->add_section( 'imma_stats', array(
			'title' => esc_html__( 'Stats', 'imma' ),
			'panel' => 'imma_frontpage_sections',
			'priority' => apply_filters( 'imma_section_priority', 50, 'imma_stats' ),
		));


		$wp_customize->add_setting( 'imma_stats_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default' => false,
		) );
		$wp_customize->add_control( 'imma_stats_hide', array(
			'type' => 'checkbox',
			'label' => esc_html__( 'Disable section','imma' ),
			'section' => 'imma_stats',
			'priority' => 1,
		) );


		$default = imma_get_stats_content_default();
		$wp_customize->add_setting( 'imma_stats_content', array(
			'default' => $default,
			'sanitize_callback' => 'customizer_repeater_sanitize',
			'transport' => $selective_refresh ? 'postMessage' : 'refresh',
		));
		$wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'imma_stats_content', array(
			'label'   => esc_html__( 'Stats Content','imma' ),
			'section' => 'imma_stats',
			'priority' => 5,
			'customizer_repeater_title_control' => true,
			'customizer_repeater_subtitle_control' => true,
			'customizer_repeater_link_control' => true,
			'customizer_repeater_color_control' => true,
			'customizer_repeater_icon_control' => true,
		)));


		$default = current_user_can( 'edit_posts' ) ? get_template_directory_uri() . '/img/stats.jpg': false;
		$wp_customize->add_setting( 'imma_stats_background_image', array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
			'default'           => $default,
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'imma_stats_background_image', array(
			'label'    => esc_html__( 'Background Image', 'imma' ),
			'section'  => 'imma_stats',
			'priority' => 10,
		) ) );
	}
	add_action( 'customize_register', 'imma_stats_customize_register' );
endif;

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_stats_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_stats_content', array(
		'selector'        => '.stats .section-content',
		'settings'        => 'imma_stats_content',
		'render_callback' => 'imma_get_stats_content',
	) );

	$wp_customize->selective_refresh->add_partial( 'imma_stats_background_image', array(
		'selector' => '.stats-css',
		'settings' => 'imma_stats_background_image',
		'render_callback' => 'imma_partial_callback_stats_background',
	) );
}
add_action( 'customize_register', 'imma_register_stats_partials' );

/**
 * Return default content for stats repeater
 * @return mixed|string|void
 */
function imma_get_stats_content_default(){
	if( ! current_user_can( 'edit_posts' ) ){
		return '';
	}
	return json_encode( array(
		array(
			'color' => '#ea2e49',
			'icon_value' => 'fa-bar-chart',
			'link' => '#',
			'title'       => esc_html__( '1.300+', 'imma' ),
			'subtitle' => esc_html__( 'Satisfied Clients', 'imma' ),
		),
		array(
			'color' => '#daede2',
			'icon_value' => 'fa-clipboard',
			'link' => '#',
			'title'       => esc_html__( '100+', 'imma' ),
			'subtitle' => esc_html__( 'Projects Done', 'imma' ),
		),
		array(
			'color' => '#77c4d3',
			'icon_value' => 'fa-clock-o',
			'link' => '#',
			'title'       => esc_html__( '20.000+', 'imma' ),
			'subtitle' => esc_html__( 'Hours of Work', 'imma' ),
		),
		array(
			'color' => '#f6f792',
			'icon_value' => 'fa-pencil',
			'link' => '#',
			'title'       => esc_html__( '300+', 'imma' ),
			'subtitle' => esc_html__( 'Positive Feedbacks', 'imma' ),
		),
	) );
}



/**
 * Render callback for ribbon background selective refresh.
 */
function imma_partial_callback_stats_background(){
	$imma_stats_background_image = get_theme_mod('imma_stats_background_image'); ?>
	<style class="imma-stats-css">
		.stats {
			background-image: url(<?php echo !empty( $imma_stats_background_image ) ? esc_url($imma_stats_background_image) : 'none' ?>);
		}
	</style>
	<?php
}