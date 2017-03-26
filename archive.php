<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package imma
 */

get_header();
$imma_blog_archive_header_hide = get_theme_mod( 'imma_blog_archive_header_hide', false );
if ( (bool) $imma_blog_archive_header_hide === false ) {
	imma_page_header( 'archive' );
}
$has_sidebar  = is_active_sidebar( 'sidebar-1' );
$class_to_add = $has_sidebar ? 'col-md-8 col-sm-12' : 'col-xs-12'; ?>
	<div class="container">
		<div class="row">

			<div id="primary" class="content-area <?php esc_attr_e( $class_to_add ); ?>">
				<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) :
						if( $imma_blog_archive_header_hide === true ) { ?>

							<header class="page-header">
								<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="archive-description">', '</div>' );
								?>
							</header><!-- .page-header -->

							<?php
						}
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						the_posts_navigation();

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
