<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package imma
 */

get_header();
$imma_search_header_hide = get_theme_mod( 'imma_search_header_hide', false );
imma_page_header( 'search', 'imma_search_header_hide' );
$imma_search_sidebar_hide = get_theme_mod( 'imma_search_sidebar_hide', false );
$has_sidebar  = is_active_sidebar( 'sidebar-1' );
$class_to_add = $has_sidebar && ! $imma_search_sidebar_hide ? 'col-md-8 col-sm-12' : 'col-xs-12'; ?>

	<div class="container">
		<div class="row">

			<section id="primary" class="content-area <?php esc_attr_e( $class_to_add ); ?>">
				<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) :
						if ( $imma_search_header_hide === true ) { ?>
							<header class="page-header">
								<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'imma' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
							</header><!-- .page-header -->
							<?php
						}

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</main><!-- #main -->
			</section><!-- #primary -->
			<?php
			if( (bool)$imma_search_sidebar_hide !== true ){
				get_sidebar();
			} ?>
		</div>
	</div>
<?php
get_footer();
