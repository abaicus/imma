<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package imma
 */

get_header();

$imma_blog_index_title_hide = get_theme_mod( 'imma_blog_index_title_hide', false );
if ( (bool) $imma_blog_index_title_hide === false ) {
	imma_page_header( 'blog' );
}
$has_sidebar = is_active_sidebar('sidebar-1');
$class_to_add = $has_sidebar ? 'col-md-8 col-sm-12' : 'col-xs-12'; ?>

	<div class="container">
		<div class="row">

			<div id="primary" class="<?php esc_attr_e( $class_to_add ); ?> content-area">
				<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

							<?php
						endif;

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						the_posts_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php
get_footer();
