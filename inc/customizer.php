<?php
/**
 * imma Theme Customizer
 *
 * @package imma
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function imma_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_panel( 'imma_frontpage_sections', array(
		'priority'    => 30,
		'title'       => esc_html__( 'Frontpage Sections', 'imma' ),
		'description' => esc_html__( 'Drag and drop panels to change sections order.', 'imma' ),
	) );

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

	if( $selective_refresh === true ){
		$wp_customize->get_setting( 'header_image' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_image_data' )->transport = 'postMessage';
	}

	$default = __( 'Edit this title in customizer', 'imma' );
	$wp_customize->add_setting( 'imma_blog_index_title', array(
		'default'           => $default,
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => $selective_refresh ? 'postMessage' : 'refresh',
	) );
	$wp_customize->add_control( 'imma_blog_index_title', array(
		'label'    => __( 'Title', 'imma' ),
		'section'  => 'title_tagline',
		'priority' => 5,
	) );

	//Advanced options
	$wp_customize->add_section( 'imma_blog_index', array(
		'title'    => esc_html__( 'Advanced options', 'imma' ),
		'priority' => 50,
	) );

	$sections = array(
		esc_html__('blog_index','imma') => array( false, true),
		esc_html__('single','imma') => array( false, false),
		esc_html__('archive','imma') => array( false, false),
		esc_html__( 'search','imma') => array( false, false), );
	$priority = 5;
	foreach ( $sections as $section => $default ){
		$wp_customize->add_setting( 'imma_'.$section.'_header_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default'           => $default[0],
		) );

		$wp_customize->add_control( 'imma_'.$section.'_header_hide', array(
			'type'     => 'checkbox',
			'label'    => sprintf( esc_html__( 'Disable header section on %s', 'imma' ), esc_html( $section ) ),
			'section'  => 'imma_blog_index',
			'priority' => $priority,
		) );
		$priority += 5;
		$wp_customize->add_setting( 'imma_'.$section.'_sidebar_hide', array(
			'sanitize_callback' => 'imma_sanitize_checkbox',
			'default'           => $default[1],
		) );
		$wp_customize->add_control( 'imma_'.$section.'_sidebar_hide', array(
			'type'     => 'checkbox',
			'label'    => sprintf( esc_html__( 'Disable sidebar on %s', 'imma' ), esc_html( $section ) ),
			'section'  => 'imma_blog_index',
			'priority' => $priority,
		) );
		$priority += 5;
	}

}
add_action( 'customize_register', 'imma_customize_register' );

/**
 * Register controls for selective refresh
 * @param WP_Customize_Manager $wp_customize Customizer
 */
function imma_register_generic_partials( $wp_customize ){
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'imma_blog_index_title', array(
		'selector'        => '.blog .shop-page-title-inner',
		'settings'        => 'imma_blog_index_title',
		'render_callback' => 'imma_blog_index_title_render_callback',
	) );

	$wp_customize->selective_refresh->add_partial( 'header_image', array(
		'selector' => '.blog-title-css',
		'settings' => 'header_image',
		'render_callback' => 'imma_blog_image_selective_refresh',
	));
}
add_action( 'customize_register', 'imma_register_generic_partials' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function imma_customize_preview_js() {
	wp_enqueue_script( 'imma_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'imma_customize_preview_js' );


if ( ! function_exists( 'imma_sanitize_checkbox' ) ) :
	/**
	 * Sanitize checkbox output.
	 *
	 * @since Imma 1.0
	 */
	function imma_sanitize_checkbox( $input ) {
		return ( isset( $input ) && true === (bool) $input ? true : false );
	}
endif;


/**
 * Callback for blog image selective refresh
 */
function imma_blog_image_selective_refresh() {
	$header_image = get_header_image();
	if ( empty( $header_image ) ) {
		$page_for_posts = get_option( 'page_for_posts' );
		$header_image = wp_get_attachment_url( get_post_thumbnail_id( $page_for_posts ) );
	} ?>
	<style class="imma-blog-title-css">
		.shop-entry-header {
			background-image: url(<?php echo ! empty( $header_image ) ? esc_url( $header_image ) : 'none' ?>) !important;
		}
	</style>
	<?php
}


/**
 * Render callback for blog index title selective refresh
 */
function imma_blog_index_title_render_callback() {
	return get_theme_mod( 'imma_blog_index_title' );
}