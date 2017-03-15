<?php
/**
 * About Section
 *
 * @since 1.0.0
 * @package Imma
 *
 */

if ( ! function_exists( 'imma_about' ) ) {
	/**
	 * About section content.
	 *
	 * @since Imma 1.0
	 */
	function imma_about() {
		$page_id      = get_the_ID();
		$page_content = get_post_field( 'post_content', $page_id );
		if ( empty( $page_content ) ) {
			return;
		}

		if ( is_customize_preview() ) {
			$imma_frontpage_featured = get_theme_mod( 'imma_feature_thumbnail' );
		} else {
			if ( has_post_thumbnail() ) {
				$imma_frontpage_featured = get_the_post_thumbnail_url();
			}
		} ?>

		<section id="product" class="product">
			<div class="container-half container-half-left"></div>
			<div class="container-half container-half-right" <?php echo ! empty( $imma_frontpage_featured ) ? ' style="background-image: url(' . esc_url( $imma_frontpage_featured ) . ')"' : ''; ?> ></div>
			<div class="container">
				<div class="row">
					<div class="col-sm-5 product-content">
						<?php
						// Show the selected frontpage content
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', 'frontpage' );
							endwhile;
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
					</div>
				</div>
			</div>

		</section>

	<?php }
}

if ( function_exists( 'imma_about' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 30, 'imma_about' );
	add_action( 'imma_sections', 'imma_about', absint( $section_priority ) );
}