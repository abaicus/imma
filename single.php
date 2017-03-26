<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package imma
 */

get_header();
$imma_blog_single_header_hide = get_theme_mod( 'imma_blog_single_header_hide', false );
if ( (bool) $imma_blog_single_header_hide === false ) {
	imma_page_header( 'single' );
}
$has_sidebar  = is_active_sidebar( 'sidebar-1' );
$class_to_add = $has_sidebar ? 'col-md-8 col-sm-12' : 'col-xs-12'; ?>
	<div class="container">
		<div class="row">

			<div id="primary" class="<?php esc_attr_e( $class_to_add ); ?> content-area">
				<main id="main" class="site-main" role="main">


					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'single' );

						the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php
get_footer();
