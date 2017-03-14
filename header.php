<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'capri-pro' ); ?></a>

		<header id="masthead" class="site-header" role="banner">
			<div class="container header-container">
				<div class="site-header-main">
					<div class="site-branding">
						<?php
						if ( function_exists( 'the_custom_logo' ) ) {
							the_custom_logo();
						} ?>

						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif;
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<button id="menu-toggle" class="menu-toggle">
						<div class="menu-icon">
							<div class="line_one"></div>
							<div class="line_two"></div>
							<div class="line_three"></div>
						</div>
					</button>
					<div id="site-header-menu" class="site-header-menu">

						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'capri-pro' ); ?>">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class'     => 'primary-menu',
								'fallback_cb'    => 'imma_fallback_menu',
							) );
							?>
						</nav><!-- .main-navigation -->

					</div><!-- .site-header-menu -->
				</div><!-- .site-header-main -->
			</div>
		</header><!-- .site-header -->

		<div id="content" class="site-content">