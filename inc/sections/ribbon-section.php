<?php
/**
 * Ribbon Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_ribbon' ) ) {
	function imma_ribbon() {

		$imma_ribbon_hide = get_theme_mod( 'imma_ribbon_hide', esc_html__( '', 'imma' ) );

		if ( (bool) $imma_ribbon_hide === true ) {
			return;
		}

		$imma_ribbon_title       = get_theme_mod( 'imma_ribbon_title', esc_html__( '', 'imma' ) );
		$imma_ribbon_button_text = get_theme_mod( 'imma_ribbon_button_text', esc_html__( '', 'imma' ) );
		$imma_ribbon_button_link = get_theme_mod( 'imma_ribbon_button_link', esc_url( '', 'imma' ) );

//		TODO: Add Below theme mod with others in a inline style
//$imma_ribbon_background_image = get_theme_mod('imma_ribbon_background_image', esc_url('', 'imma') );

		if ( ! empty( $imma_ribbon_title ) || ( ! empty( $imma_ribbon_button_link ) && ! empty( $imma_ribbon_button_text ) ) ) {

			?>

			<section id="ribbon" class="ribbon">
				<div class="container">
					<div class="row">
						<?php if ( ! empty( $imma_ribbon_title ) ) { ?>
							<div class="col-lg-8 col-sm-12 text-wrapper">
								<h2><?php echo wp_kses_post( $imma_ribbon_title ); ?></h2>
							</div>
						<?php } ?>
						<?php if ( ! empty( $imma_ribbon_button_link ) && ! empty( $imma_ribbon_button_text ) ) { ?>
							<div class="col-lg-3 col-sm-12 button-wrapper">
								<a href="<?php echo esc_url( $imma_ribbon_button_link ) ?>" class="btn btn-yellow btn-lg btn-outline"> <?php echo esc_html( $imma_ribbon_button_text ); ?> </a>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>

			<?php
		}
	}
}

if ( function_exists( 'imma_ribbon' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 20, 'imma_ribbon' );
	add_action( 'imma_sections', 'imma_ribbon', absint( $section_priority ) );
}