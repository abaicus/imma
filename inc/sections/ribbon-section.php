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

		$default = current_user_can( 'edit_posts' ) ? sprintf(
			__( 'Edit this section text in %1$s', 'imma' ),
			sprintf( '<a class="link-to-customizer" href="%1$s">%2$s</a>',
				admin_url( 'customize.php?autofocus[control]=imma_ribbon_title' ),
				__( 'customizer', 'imma' ) )
		) : false;
		$imma_ribbon_title       = get_theme_mod( 'imma_ribbon_title', $default );

		$default = current_user_can( 'edit_posts' ) ? esc_html__( 'Edit button label in customizer', 'imma' ) : false;
		$imma_ribbon_button_text = get_theme_mod( 'imma_ribbon_button_text', $default );

		$default = admin_url( 'customize.php?autofocus[control]=imma_ribbon_button_text' );
		$imma_ribbon_button_link = get_theme_mod( 'imma_ribbon_button_link', $default ); ?>

		<section id="ribbon" class="ribbon">
			<?php
			if ( is_customize_preview() ) { ?>
				<div class="ribbon-css"></div>
				<?php
			} ?>
			<div class="container">
				<div class="row">
					<?php
					if ( ! empty( $imma_ribbon_title ) ) { ?>
						<div class="col-lg-8 col-sm-12 text-wrapper">
							<h2><?php echo wp_kses_post( $imma_ribbon_title ); ?></h2>
						</div>
						<?php
					}

					if ( ! empty( $imma_ribbon_button_link ) && ! empty( $imma_ribbon_button_text ) ) { ?>
						<div class="col-lg-3 col-sm-12 button-wrapper">
							<a href="<?php echo esc_url( $imma_ribbon_button_link ) ?>" class="btn btn-yellow btn-lg btn-outline">
								<?php echo esc_html( $imma_ribbon_button_text ); ?>
							</a>
						</div>
						<?php
					} ?>
				</div>
			</div>
		</section>
		<?php
	}
}

if ( function_exists( 'imma_ribbon' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 20, 'imma_ribbon' );
	add_action( 'imma_sections', 'imma_ribbon', absint( $section_priority ) );
}