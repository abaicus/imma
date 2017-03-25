<?php
/**
 * Portfolio Section
 *
 * @since 1.0.0
 * @package imma
 *
 */
if ( class_exists( 'Jetpack' ) ) {

	if ( Jetpack::is_module_active( 'custom-content-types' ) ) {

		if ( ! function_exists( 'imma_portfolio' ) ) {
			function imma_portfolio() {
				$imma_portfolio_hide = get_theme_mod( 'imma_portfolio_hide' );
				if ( (bool) $imma_portfolio_hide === true ) {
					return;
				}
				?>
				<section id="portfolio" class="portfolio">
					<div class="container">
						<?php imma_display_section_head( 'imma_portfolio_title', 'imma_portfolio_subtitle' );

						imma_get_portfolio_content();
						?>
					</div>
				</section>
			<?php }
		}
	}
}
if ( function_exists( 'imma_portfolio' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 40, 'imma_portfolio' );
	add_action( 'imma_sections', 'imma_portfolio', absint( $section_priority ) );
}

function imma_get_portfolio_content() {

	$imma_portfolio_posts_count = get_theme_mod( 'imma_portfolio_posts_count', 4 );

	if ( ! empty( $imma_portfolio_posts_count ) && $imma_portfolio_posts_count !== 0 ) {
		$post = new WP_Query( array(
			'post_type'      => 'jetpack-portfolio',
			'posts_per_page' => absint( $imma_portfolio_posts_count )
		) );
	} else {
		$post = new WP_Query( array( 'post_type' => 'jetpack-portfolio', 'posts_per_page' => 2 ) );
	}

	if ( $post->have_posts() ) { ?>

		<div class="portfolio-items">
			<div class="row">

				<?php $counter = 1;

				while ( $post->have_posts() ) : $post->the_post();
				?>

				<div class="col-sm-6 col-xs-12">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<div class="card card-inverse">
						<img class="card-img"
						     src="<?php echo the_post_thumbnail_url( 'imma-portfolio' ); ?>"
						     alt="<?php the_title_attribute(); ?>">
						<div class="card-img-overlay text-center">
							<div class="card-caption-wrapper">

								<h4 class="card-title lead"><?php the_title_attribute(); ?></h4>
								<?php $portfolio_categories = get_the_terms( $post->ID , 'jetpack-portfolio-type' );
								if ( ! empty( $portfolio_categories ) ) { ?>
								<p class="card-text"><?php foreach ( $portfolio_categories as $category ) { ?>
										<a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></a>
									<?php }
									} ?>
							</div>
						</div>
					</div>
					</a>
				</div>
				<?php if( $counter % 2 === 0 ) { ?>
						</div>
					<div class="row">
				<?php }

				$counter++;

				endwhile; ?>

			</div>
		</div>
		<?php
	}
}

if ( function_exists( 'imma_portfolio' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 40, 'imma_portfolio' );
	add_action( 'imma_sections', 'imma_portfolio', absint( $section_priority ) );
}