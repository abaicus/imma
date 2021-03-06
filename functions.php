<?php
/**
 * imma functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package imma
 */

define( "IMMA_INCLUDE_DIR", get_template_directory() . '/inc' );

if ( ! function_exists( 'imma_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function imma_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on imma, use a find and replace
	 * to change 'imma' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'imma', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'imma' ),
	) );

	/**
	 * Image sizes
	 */
	add_image_size( 'imma-blog-size', 600, 400 );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'imma_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add theme support for custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	$args = array(
		'default-image'      => current_user_can( 'edit_posts' ) ? get_template_directory_uri() . '/img/blog_default.jpg' : '',
		'width'              => 1000,
		'height'             => 500,
		'flex-width'         => true,
		'flex-height'        => true,
	);
    add_theme_support( 'custom-header', $args );

		// Image sizes.
	add_image_size( 'imma-portfolio', 560, 380, true );
}
endif;
add_action( 'after_setup_theme', 'imma_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function imma_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'imma_content_width', 640 );
}
add_action( 'after_setup_theme', 'imma_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function imma_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'imma' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'imma' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'imma_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function imma_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), '3.3.7', 'all' );

	wp_enqueue_style( 'imma-style', get_stylesheet_uri() );

	wp_enqueue_style( 'imma-header', get_template_directory_uri() . '/css/generated-style.css', false, '1.0', 'all' );

	wp_enqueue_style( 'imma-font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.css', false, '4.7.0', 'all' );

	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );

	wp_enqueue_script( 'imma-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	$imma_video_hide = get_theme_mod( 'imma_video_hide', true );
	if( is_front_page() && ( (bool)$imma_video_hide === false ) ) {
		wp_enqueue_script( 'imma-youtube-player', get_template_directory_uri() . '/js/YTPlayer.min.js', array('jquery'), '1.0', true );
	}

	wp_enqueue_script( 'imma-custom-js', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0', true );

	wp_localize_script( 'imma-navigation', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'imma' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'imma' ) . '</span>',
	) );

	wp_enqueue_script( 'imma-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'imma_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Filter the front page template so it's bypassed entirely if the user selects
 * to display blog posts on their homepage instead of a static page.
 */
function imma_filter_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'imma_filter_front_page_template' );

/**
 * Define Allowed Files to be included.
 *
 * @since Imma 1.0
 */
function imma_filter_features( $array ) {
	return array_merge( $array, array(

		'/sections/hero-section',

		'/sections/big-title-section',
		'/features/feature-big-title-section',

		'/sections/slider-section',
		'/features/feature-slider-section',

		'/sections/services-section',
		'/features/feature-services-section',

		'/sections/ribbon-section',
		'/features/feature-ribbon-section',

		'/sections/about-section',
		'/features/feature-about-section',

		'/sections/portfolio-section',
		'/features/feature-portfolio-section',

		'/sections/stats-section',
		'/features/feature-stats-section',

		'/sections/blog-section',
		'/features/feature-blog-section',

		'/sections/clients-section',
		'/features/feature-clients-section',

		'/sections/video-section',
		'/features/feature-video-section',
	));
}
add_filter( 'imma_filter_features', 'imma_filter_features' );

/**
 * Include features files.
 *
 * @since Imma 1.0
 */
function imma_include_features() {
	$inc_dir = rtrim( IMMA_INCLUDE_DIR, '/' );
	$allowed_phps = array();
	$allowed_phps = apply_filters( 'imma_filter_features', $allowed_phps );
	foreach ( $allowed_phps as $file ) {
		$file_to_include = $inc_dir . $file . '.php';
		if ( file_exists( $file_to_include ) ) {
			include_once( $file_to_include );
		}
	}
}
add_action( 'after_setup_theme', 'imma_include_features' );