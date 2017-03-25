<?php
/**
 * Customizer functionality for the About section.
 *
 * @package WordPress
 * @subpackage Imma
 * @since Imma 1.0
 */
// Register customizer page editor functions
require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-modules/customizer-page-editor/customizer-page-editor.php' );
/**
 * Hook controls for About section to Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since Imma 1.0
 */
function imma_about_customize_register( $wp_customize ) {
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;
	$frontpage_id = get_option( 'page_on_front' );
	$wp_customize->add_section( 'imma_about', array(
		'title' => esc_html__( 'About', 'imma' ),
		'panel' => 'imma_frontpage_sections',
		'priority' => apply_filters( 'imma_section_priority', 30, 'imma_about' ),
	));
	$default = '';
	if ( ! empty( $frontpage_id ) ) {
		$content_post = get_post( $frontpage_id );
		$default      = $content_post->post_content;
		$default      = apply_filters( 'the_content', $default );
		$default      = str_replace( ']]>', ']]&gt;', $default );
	}
	$wp_customize->add_setting( 'imma_page_editor', array(
		'default'        => $default,
		'sanitize_callback' => 'wp_kses_post',
		'transport' => $selective_refresh ? 'postMessage' : 'refresh',
	) );
	$wp_customize->add_control( new Imma_Page_Editor( $wp_customize, 'imma_page_editor', array(
		'label'   => __( 'About Content','imma' ),
		'section' => 'imma_about',
		'priority' => 10,
		'needsync' => true,
	) ) );
	$default = '';
	if ( has_post_thumbnail( $frontpage_id ) ) {
		$default = get_the_post_thumbnail_url( $frontpage_id );
	}
	$wp_customize->add_setting( 'imma_feature_thumbnail', array(
		'sanitize_callback' => 'esc_url',
		'default'        => $default,
		'transport' => $selective_refresh ? 'postMessage' : 'refresh',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'imma_feature_thumbnail', array(
		'label'    => esc_html__( 'About image', 'imma' ),
		'section'  => 'imma_about',
		'priority'    => 15,
		// 'active_callback'   => 'imma_is_static_page',
	)));
}
add_action( 'customize_register', 'imma_about_customize_register' );
/**
 * Add selective refresh for about section controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function imma_register_about_partials( $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}
	$wp_customize->selective_refresh->add_partial( 'imma_page_editor', array(
		'selector' => '.product-content',
		'settings' => 'imma_page_editor',
		'render_callback' => 'imma_text_editor_render_callback',
	));
	$wp_customize->selective_refresh->add_partial( 'imma_feature_thumbnail', array(
		'selector'        => '.product .container-half-right',
		'settings'        => 'imma_feature_thumbnail',
		'render_callback' => 'imma_about_image_render_callback',
	));
}
add_action( 'customize_register', 'imma_register_about_partials' );

/**
 * Render callback for about text selective refresh.
 */
function imma_text_editor_render_callback() {
	return get_theme_mod( 'imma_page_editor' );
}

/**
 * Render callback for about image selective refresh.
 */
function imma_about_image_render_callback() {
	$imma_about_image = get_theme_mod( 'imma_feature_thumbnail' );
	if ( ! empty( $imma_about_image ) ) { ?>
		<style class="about-image-css">
			.product .container-half-right {
				background-image: url(<?php echo ! empty( $imma_about_image ) ? esc_url( $imma_about_image ) : 'none' ?>) !important;
			}
		</style>
		<?php
	}
}