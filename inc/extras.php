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
 *
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
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	$fb_output       = null;
	$container       = $args['container'];
	$container_id    = $args['container_id'];
	$container_class = $args['container_class'];
	$menu_id         = $args['menu_id'];
	$menu_class      = $args['menu_class'];
	if ( $container ) {
		$fb_output = '<' . $container;
		if ( $container_id ) {
			$fb_output .= ' id="' . $container_id . '"';
		}
		if ( $container_class ) {
			$fb_output .= ' class="' . $container_class . '"';
		}
		$fb_output .= '>';
	}
	$fb_output .= '<ul';
	if ( $menu_id ) {
		$fb_output .= ' id="' . $menu_id . '"';
	}
	if ( $menu_class ) {
		$fb_output .= ' class="' . $menu_class . '"';
	}
	$fb_output .= '>';
	$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Add a menu', 'imma' ) . '</a></li>';
	$fb_output .= '</ul>';
	if ( $container ) {
		$fb_output .= '</' . $container . '>';
	}
	echo $fb_output;
}

/**
 * Theme inline style.
 */
function imma_inline_style() {
	$custom_css = '';

	$default                   = current_user_can( 'edit_posts' ) ? get_template_directory_uri() . '/img/cover.jpg' : false;
	$imma_big_title_background = get_theme_mod( 'imma_big_title_background', $default );

	$default                      = current_user_can( 'edit_posts' ) ? get_template_directory_uri() . '/img/ribbon.jpg' : false;
	$imma_ribbon_background_image = get_theme_mod( 'imma_ribbon_background_image', $default );


	$default                     = current_user_can( 'edit_posts' ) ? get_template_directory_uri() . '/img/stats.jpg' : false;
	$imma_stats_background_image = get_theme_mod( 'imma_stats_background_image', $default );

	if ( ! empty( $imma_big_title_background ) ) {
		$custom_css .= '#cover{
				background: url(' . esc_url( $imma_big_title_background ) . ')
		}';
	}

	if ( ! empty( $imma_ribbon_background_image ) ) {
		$custom_css .= ' .ribbon{
			    background: url(' . esc_url( $imma_ribbon_background_image ) . ');
		}';
	}

	if ( ! empty( $imma_stats_background_image ) ) {
		$custom_css .= ' .stats{
			    background: url(' . esc_url( $imma_stats_background_image ) . ');
		}';
	}

	wp_add_inline_style( 'imma-style', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'imma_inline_style' );


/**
 * Display section title.
 *
 * @param string $title Section title.
 * @param string $subtitle Section subtitle.
 */
function imma_display_section_head( $title, $subtitle ) {
	$default  = current_user_can( 'edit_posts' ) ? sprintf(
		__( 'Edit this section title in %1$s', 'imma' ),
		sprintf( '<a class="link-to-customizer" href="%1$s">%2$s</a>',
			admin_url( 'customize.php?autofocus[control]=imma_services_title' ),
			__( 'customizer', 'imma' ) )
	) : false;
	$title    = get_theme_mod( $title, $default );
	$default  = current_user_can( 'edit_posts' ) ? sprintf(
		__( 'Edit this section subtitle in %1$s', 'imma' ),
		sprintf( '<a class="link-to-customizer" href="%1$s">%2$s</a>',
			admin_url( 'customize.php?autofocus[control]=imma_services_subtitle' ),
			__( 'customizer', 'imma' ) )
	) : false;
	$subtitle = get_theme_mod( $subtitle, $default );
	?>
	<div class="row">
		<div class=" col-md-12">
			<?php
			if ( ! empty( $title ) ) { ?>
				<h2 class="text-center section-title"><?php echo wp_kses_post( $title ) ?></h2>
				<?php
			}
			if ( ! empty( $subtitle ) ) { ?>
				<p class="text-center lead section-subtitle"><?php echo wp_kses_post( $subtitle ); ?></p>
				<?php
			} ?>
		</div>
	</div>
	<?php
}

/**
 * Excerpt length.
 */
function imma_excerpt_length( $length ) {
	return 100;
}

add_filter( 'excerpt_length', 'imma_excerpt_length', 999 );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function imma_excerpt_more() {
	global $post;
	$link = sprintf( '<a href="%1$s" class="more-link btn btn-yellow">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read more <span class="screen-reader-text"> "%s"</span>', 'imma' ), get_the_title( get_the_ID() ) )
	);

	return '&hellip; ' . $link;
}

add_filter( 'excerpt_more', 'imma_excerpt_more' );

/**
 *
 */
function imma_page_header( $page_type ) {
	switch ( $page_type ) {
		case 'shop':
			$category = get_queried_object();
			if ( isset( $category->term_id ) ) {
				$category_id = $category->term_id;
				$meta        = get_term_meta( $category_id );
				if ( ! empty( $meta['thumbnail_id'][0] ) ) {
					$image = wp_get_attachment_url( $meta['thumbnail_id'][0] );
				} else {
					$image = get_header_image();
				}
				$page_title = woocommerce_page_title( false );
			} else {
				$shop_page_id = get_option( 'woocommerce_shop_page_id' );
				$image        = wp_get_attachment_url( get_post_thumbnail_id( $shop_page_id ) );
				if ( empty( $image ) ) {
					get_header_image();
				}
				$page_title = get_the_title( $shop_page_id );
			}
			break;
		case 'blog':
			$page_for_posts = get_option( 'page_for_posts' );
			$url            = admin_url( 'customize.php?autofocus[control]=imma_blog_index_title&url=' . get_page_link( $page_for_posts ) );
			$default        = current_user_can( 'edit_posts' ) ? sprintf(
				__( 'Edit this title in %1$s', 'imma' ),
				sprintf( '<a class="link-to-customizer" href="%1$s">%2$s</a>',
					esc_url( $url ),
					__( 'customizer', 'imma' ) )
			) : false;
			if ( ! empty( $page_for_posts ) && $page_for_posts !== '0' ) {
				$image = wp_get_attachment_url( get_post_thumbnail_id( $page_for_posts ) );
				if ( empty( $image ) ) {
					$image = get_header_image();
				}
				$page_title = get_theme_mod( 'imma_blog_index_title', $default );
				if ( empty( $page_title ) ) {
					$page_title = get_the_title( $page_for_posts );
				}
			} else {
				$image      = get_header_image();
				$page_title = get_theme_mod( 'imma_blog_index_title', $default );
			}
			break;
		case 'archive':
			$image      = get_header_image();
			$page_title = get_the_archive_title();
			break;

		case 'single':

			$image      = get_the_post_thumbnail_url();
			if( empty( $image ) ) {
				$image = get_header_image();
			}
			$page_title = get_the_title();

	}
	?>
	<div class="shop-entry-header" <?php if ( ! empty( $image ) ) {
		echo 'style="background-image: url(' . esc_url( $image ) . ');"';
	} ?>>
		<?php
		if ( is_customize_preview() ) { ?>
			<div class="blog-title-css"></div>
			<?php
		} ?>
		<div class="overlay"></div>
		<div class="container">
			<div class="shop-page-title-wrap">
				<?php
				if ( ! empty( $page_title ) ) { ?>
					<h2 class="shop-page-title-inner">
						<?php
						echo wp_kses_post( $page_title ); ?>
					</h2>
					<?php
				}
				if( $page_type === 'single' ) {
					imma_get_post_meta();
				}?>

			</div>
		</div>
	</div>
	<?php
}

function imma_get_post_meta() {
	$pid = get_the_ID();
	if( empty( $pid ) ){
		return;
	}

	$post_author = get_post_field( 'post_author', $pid );
	$author_name = get_the_author_meta( 'user_nicename', $post_author );
	?>
	<div class="index-post-meta">
		<div
			class="author"><?php printf( esc_html__( 'By %1$s, %2$s', 'imma' ), sprintf( '<a href="%2$s" title="%1$s"><b>%1$s</b></a>', esc_html( $author_name ) , esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ), sprintf( esc_html__( '%1$s ago %2$s', 'imma' ), sprintf( '<a href="%2$s"><time>%1$s</time>', esc_html( human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ), esc_url( get_permalink() ) ), '</a>' ) ); ?></div>

		<?php
		$categories = get_the_category( $pid );
		if ( ! empty( $categories ) ) { ?>
			<div class="categories-list">
				<?php foreach ( $categories as $category ) { ?>
					<span class="category-label"><a
							href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></span>
					<?php
				} ?>
			</div>
		<?php } ?>
	</div>
	<?php
}
