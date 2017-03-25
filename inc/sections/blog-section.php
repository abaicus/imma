<?php
/**
 * Blog Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_blog' ) ) {
	function imma_blog() {
		$imma_blog_hide = get_theme_mod('imma_blog_hide');
		if( (bool) $imma_blog_hide === true ){
			return;
		} ?>

		<section id="blog-section" class="blog-section">
			<div class="container">

				<?php imma_display_section_head( 'imma_blog_title', 'imma_blog_subtitle' ); ?>
				<div class="row section-content">
					<?php imma_display_blog_content(); ?>
				</div>

			</div>
		</section>

	<?php }
}

if ( function_exists( 'imma_blog' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 60, 'imma_blog' );
	add_action( 'imma_sections', 'imma_blog', absint( $section_priority ) );
}

/**
 * Display blog content.
 */
function imma_display_blog_content(){
	$imma_blog_post_number = get_theme_mod('imma_blog_post_number', 3);
	$imma_blog_categories_multiple_select = get_theme_mod('imma_blog_categories_multiple_select');

	if( $imma_blog_categories_multiple_select[0] === 'none' || $imma_blog_post_number === 0 ){
		return;
	}
	$args = array(
		'ignore_sticky_posts ' => true,
		'posts_per_page' => ! empty( $imma_blog_post_number ) ?  $imma_blog_post_number : 0 ,
		'category__in' => ! empty( $imma_blog_categories_multiple_select ) ? $imma_blog_categories_multiple_select : '',
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		$count = 1;
		while ( $the_query->have_posts() ) {
			$the_query->the_post(); ?>

			<div class="blog-post">
				<?php
				$class_to_add = 'col-md-5';
				if( ! has_post_thumbnail() ){
					$class_to_add = 'col-md-12';
				}
				if( $count % 2 === 0){
					if( has_post_thumbnail() ){ ?>
						<div class="col-md-7 col-sm-12 col-xs-12 blog-post-image">
							<img src="<?php the_post_thumbnail_url('imma-blog-size'); ?>" alt="">
						</div>
						<?php
					}?>
					<div class="<?php esc_attr_e( $class_to_add ); ?> col-sm-12 col-xs-12 blog-post-content">
						<h2 class="post-title"><?php the_title(); ?></h2>

						<div class="text-content">
							<?php the_excerpt(); ?>
						</div>

					</div>
					<?php
				} else { ?>
					<div class="<?php esc_attr_e( $class_to_add ); ?> col-sm-12 col-xs-12 blog-post-content">
						<h2 class="post-title"><?php the_title(); ?></h2>

						<div class="text-content">
							<?php the_excerpt(); ?>
						</div>

					</div>
					<?php
					if( has_post_thumbnail() ){ ?>
						<div class="col-md-7 col-sm-12 col-xs-12 blog-post-image">
							<img src="<?php the_post_thumbnail_url(); ?>" alt="">
						</div>
						<?php
					}
				} ?>
			</div>

			<?php
			$count++;
		}

		/* Restore original Post Data */
		wp_reset_postdata();
	} else {
		// no posts found
	}
}