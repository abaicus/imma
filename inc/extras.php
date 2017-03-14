<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package imma
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function imma_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'imma_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function imma_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'imma_pingback_header' );

/**
 * Menu Fallback
 * =============
 * If this function is assigned to the wp_nav_menu's fallback_cb variable
 * and a manu has not been assigned to the theme location in the WordPress
 * menu manager the function with display nothing to a non-logged in user,
 * and will add a link to the WordPress menu manager if logged in as an admin.
 *
 * @param array $args passed from the wp_nav_menu function.
 */
function imma_fallback_menu( $args ) {
	if( !current_user_can( 'edit_posts' ) ){
		return;
	}
	$fb_output = null;
	$container = $args['container'];
	$container_id = $args['container_id'];
	$container_class = $args['container_class'];
	$menu_id = $args['menu_id'];
	$menu_class = $args['menu_class'];
	if ( $container ) {
		$fb_output = '<' . $container;
		if ( $container_id )
			$fb_output .= ' id="' . $container_id . '"';
		if ( $container_class )
			$fb_output .= ' class="' . $container_class . '"';
		$fb_output .= '>';
	}
	$fb_output .= '<ul';
	if ( $menu_id )
		$fb_output .= ' id="' . $menu_id . '"';
	if ( $menu_class )
		$fb_output .= ' class="' . $menu_class . '"';
	$fb_output .= '>';
	$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">'. __('Add a menu', 'imma') .'</a></li>';
	$fb_output .= '</ul>';
	if ( $container )
		$fb_output .= '</' . $container . '>';
	echo $fb_output;
}